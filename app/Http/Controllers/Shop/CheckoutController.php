<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use App\Models\Setting;
use App\Models\Shop\Coupon;
use App\Models\Shop\Order;
use App\Models\Shop\OrderItem;
use App\Models\Shop\Product;
use App\Models\Shop\ProductVariant;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Re-calculate cart prices from DB (never trust session prices).
     * Returns [verified_cart, subtotal] or redirects on error.
     */
    private function verifyCart(array $cart): array
    {
        $verifiedCart = [];

        foreach ($cart as $key => $item) {
            $product = Product::where('id', $item['product_id'])
                ->where('is_active', true)
                ->first();

            if (! $product) {
                continue; // Skip deleted/inactive products
            }

            $variant = null;
            if (! empty($item['variant_id'])) {
                $variant = ProductVariant::where('id', $item['variant_id'])
                    ->where('product_id', $product->id) // Ensure variant belongs to product
                    ->where('is_active', true)
                    ->first();

                if (! $variant) {
                    continue; // Skip invalid variant
                }
            }

            // Always use DB price, never session price
            $dbPrice = $variant
                ? (float) ($variant->price ?? $product->price)
                : (float) $product->effective_price;

            $quantity = max(1, min(99, (int) $item['quantity']));

            $verifiedCart[$key] = [
                'product_id'   => $product->id,
                'variant_id'   => $variant?->id,
                'name'         => $item['name'],
                'variant_info' => $item['variant_info'] ?? [],
                'price'        => $dbPrice,
                'image'        => $product->image,
                'quantity'     => $quantity,
            ];
        }

        $subtotal = collect($verifiedCart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return [$verifiedCart, $subtotal];
    }

    public function show()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('front.cart')->with('error', 'Sepetiniz boş.');
        }

        [$verifiedCart, $subtotal] = $this->verifyCart($cart);

        if (empty($verifiedCart)) {
            session()->forget(['cart', 'coupon']);
            return redirect()->route('front.cart')->with('error', 'Sepetinizdeki ürünler artık mevcut değil.');
        }

        // Update session with verified prices
        session(['cart' => $verifiedCart]);

        $discount = 0;
        $coupon = session('coupon');
        if ($coupon) {
            $couponModel = Coupon::find($coupon['id']);
            if ($couponModel && $couponModel->isValid($subtotal)) {
                $discount = $couponModel->calculateDiscount($subtotal);
            } else {
                session()->forget('coupon');
                $coupon = null;
            }
        }

        $total = max(0, $subtotal - $discount);
        $cart = $verifiedCart;

        return view('front.pages.checkout', compact('cart', 'subtotal', 'discount', 'coupon', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name'     => 'required|string|max:255',
            'customer_email'    => 'required|email|max:255',
            'customer_phone'    => 'nullable|string|max:30',
            'shipping_address'  => 'required|string|max:500',
            'shipping_city'     => 'required|string|max:100',
            'shipping_district' => 'nullable|string|max:100',
            'customer_note'     => 'nullable|string|max:1000',
        ], ValidationMessageService::getMessages('checkout_process'));

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('front.cart')->with('error', 'Sepetiniz boş.');
        }

        // -- SECURITY: Re-verify all prices from DB --
        [$verifiedCart, $subtotal] = $this->verifyCart($cart);

        if (empty($verifiedCart)) {
            session()->forget(['cart', 'coupon']);
            return redirect()->route('front.cart')->with('error', 'Sepetinizdeki ürünler artık mevcut değil.');
        }

        try {
        $order = DB::transaction(function () use ($request, $verifiedCart, $subtotal) {
            // -- SECURITY: Coupon with pessimistic lock to prevent race condition --
            $couponId = null;
            $couponCode = null;
            $discountAmount = 0;
            $couponSession = session('coupon');

            if ($couponSession) {
                // Lock the coupon row to prevent concurrent usage exceeding limit
                $couponModel = Coupon::where('id', $couponSession['id'])->lockForUpdate()->first();

                if ($couponModel && $couponModel->isValid($subtotal)) {
                    $discountAmount = $couponModel->calculateDiscount($subtotal);
                    $couponId = $couponModel->id;
                    $couponCode = $couponModel->code;
                    // Increment usage within the lock
                    $couponModel->increment('used_count');
                }
            }

            $total = max(0, $subtotal - $discountAmount);

            // -- SECURITY: Stock check with lock --
            foreach ($verifiedCart as $item) {
                if (! empty($item['variant_id'])) {
                    $variant = ProductVariant::where('id', $item['variant_id'])->lockForUpdate()->first();
                    $product = Product::where('id', $item['product_id'])->lockForUpdate()->first();
                } else {
                    $product = Product::where('id', $item['product_id'])->lockForUpdate()->first();
                    $variant = null;
                }

                if (! $product || ! $product->is_active) {
                    throw new \RuntimeException('Ürün artık mevcut değil: ' . ($item['name'] ?? ''));
                }

                if ($variant && ! $variant->is_active) {
                    throw new \RuntimeException('Ürün varyantı artık mevcut değil: ' . ($item['name'] ?? ''));
                }

                // Stock check
                $stockHolder = $variant ?? $product;
                if ($product->manage_stock && $stockHolder->stock !== null) {
                    if ($stockHolder->stock < $item['quantity']) {
                        throw new \RuntimeException(
                            $item['name'] . ' için yeterli stok yok. Mevcut: ' . $stockHolder->stock
                        );
                    }
                    // Decrement stock
                    $stockHolder->decrement('stock', $item['quantity']);
                }
            }

            $order = Order::create([
                'order_number'     => Order::generateOrderNumber(),
                'status'           => 'pending',
                'customer_name'    => $request->customer_name,
                'customer_email'   => $request->customer_email,
                'customer_phone'   => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city'    => $request->shipping_city,
                'shipping_district'=> $request->shipping_district,
                'customer_note'    => $request->customer_note,
                'subtotal'         => $subtotal,
                'shipping_cost'    => 0,
                'total'            => $total,
                'coupon_id'        => $couponId,
                'coupon_code'      => $couponCode,
                'discount_amount'  => $discountAmount,
            ]);

            foreach ($verifiedCart as $item) {
                OrderItem::create([
                    'order_id'           => $order->id,
                    'product_id'         => $item['product_id'],
                    'product_variant_id' => $item['variant_id'],
                    'product_name'       => $item['name'],
                    'variant_info'       => $item['variant_info'] ?: null,
                    'product_image'      => $item['image'],
                    'quantity'           => $item['quantity'],
                    'unit_price'         => $item['price'],
                    'total_price'        => $item['price'] * $item['quantity'],
                ]);
            }

            return $order;
        });
        } catch (\RuntimeException $e) {
            return redirect()->route('front.checkout')
                ->with('error', $e->getMessage());
        }

        session()->forget(['cart', 'coupon']);

        // Send order confirmation emails
        try {
            $order->load('items');
            Mail::to($order->customer_email)->send(new OrderConfirmationMail($order));

            $adminEmail = Setting::get('site_email', null, 'general');
            if ($adminEmail && $adminEmail !== $order->customer_email) {
                Mail::to($adminEmail)->send(new OrderConfirmationMail($order));
            }
        } catch (\Exception $e) {
            \Log::error('Order confirmation mail failed: ' . $e->getMessage());
        }

        return redirect()->route('front.products')
            ->with('success', 'Siparişiniz başarıyla alındı! En kısa sürede sizinle iletişime geçeceğiz.');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50',
        ], ValidationMessageService::getMessages('checkout_coupon'));

        $cart = session('cart', []);
        if (empty($cart)) {
            return response()->json(['status' => 0, 'message' => 'Sepetiniz boş.']);
        }

        // Recalculate subtotal from verified prices
        [$verifiedCart, $subtotal] = $this->verifyCart($cart);

        if (empty($verifiedCart)) {
            return response()->json(['status' => 0, 'message' => 'Sepetinizdeki ürünler mevcut değil.']);
        }

        $coupon = Coupon::where('code', strtoupper(trim($request->code)))->first();

        if (! $coupon) {
            return response()->json(['status' => 0, 'message' => 'Geçersiz kupon kodu.']);
        }

        $errorMessage = $coupon->validationMessage($subtotal);
        if ($errorMessage) {
            return response()->json(['status' => 0, 'message' => $errorMessage]);
        }

        $discount = $coupon->calculateDiscount($subtotal);
        $total = max(0, $subtotal - $discount);

        session(['coupon' => [
            'id'   => $coupon->id,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value'=> $coupon->value,
        ]]);

        return response()->json([
            'status'   => 1,
            'message'  => 'Kupon uygulandı!',
            'code'     => $coupon->code,
            'discount' => $discount,
            'total'    => $total,
            'discount_formatted' => number_format($discount, 2, ',', '.'),
            'total_formatted'    => number_format($total, 2, ',', '.'),
        ]);
    }

    public function removeCoupon()
    {
        session()->forget('coupon');

        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return response()->json([
            'status'  => 1,
            'message' => 'Kupon kaldırıldı.',
            'total'   => $subtotal,
            'total_formatted' => number_format($subtotal, 2, ',', '.'),
        ]);
    }
}

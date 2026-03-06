<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Coupon;
use App\Models\Shop\Product;
use App\Models\Shop\ProductVariant;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

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

        return view('front.pages.cart', compact('cart', 'subtotal', 'discount', 'coupon', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'variant_id' => 'nullable|integer',
            'quantity'   => 'nullable|integer|min:1|max:99',
        ], ValidationMessageService::getMessages('cart_add'));

        // SECURITY: Only allow active products
        $product = Product::where('id', $request->product_id)
            ->where('is_active', true)
            ->firstOrFail();

        $variant = null;
        if ($request->variant_id) {
            // SECURITY: Ensure variant belongs to this product and is active
            $variant = ProductVariant::with('attributeValues.attribute')
                ->where('id', $request->variant_id)
                ->where('product_id', $product->id)
                ->where('is_active', true)
                ->firstOrFail();
        }

        $key = $product->id . '_' . ($variant?->id ?? 0);
        // SECURITY: Always get price from DB
        $price = $variant ? ((float) ($variant->price ?? $product->price)) : (float) $product->effective_price;
        $locale = app()->getLocale();

        $variantInfo = [];
        if ($variant) {
            foreach ($variant->attributeValues as $val) {
                $variantInfo[$val->attribute->getTranslation('name', $locale)] = $val->getTranslation('name', $locale);
            }
        }

        $cart = session('cart', []);
        $addQty = $request->quantity ?? 1;

        if (isset($cart[$key])) {
            // SECURITY: Cap quantity at 99
            $cart[$key]['quantity'] = min(99, $cart[$key]['quantity'] + $addQty);
            // SECURITY: Always refresh price from DB
            $cart[$key]['price'] = $price;
        } else {
            $cart[$key] = [
                'product_id'   => $product->id,
                'variant_id'   => $variant?->id,
                'name'         => $product->getTranslation('name', $locale),
                'variant_info' => $variantInfo,
                'price'        => $price,
                'image'        => $product->image,
                'quantity'     => min(99, $addQty),
            ];
        }
        session(['cart' => $cart]);

        if ($request->ajax()) {
            $cartItem = $cart[$key];
            return response()->json([
                'status'     => 1,
                'message'    => 'Ürün sepete eklendi.',
                'cart_count' => collect($cart)->sum('quantity'),
                'cart_total' => collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']),
                'item'       => [
                    'key'          => $key,
                    'name'         => $cartItem['name'],
                    'image'        => $cartItem['image'] ? asset($cartItem['image']) : null,
                    'price'        => $cartItem['price'],
                    'quantity'     => $cartItem['quantity'],
                    'variant_info' => $cartItem['variant_info'],
                    'product_id'   => $cartItem['product_id'],
                    'line_total'   => $cartItem['price'] * $cartItem['quantity'],
                ],
            ]);
        }

        return redirect()->route('front.cart')->with('success', 'Ürün sepete eklendi.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'key'      => 'required|string',
            'quantity' => 'required|integer|min:0|max:99',
        ], ValidationMessageService::getMessages('cart_update'));

        $cart = session('cart', []);

        if ($request->quantity == 0) {
            unset($cart[$request->key]);
        } elseif (isset($cart[$request->key])) {
            $cart[$request->key]['quantity'] = $request->quantity;
        }

        session(['cart' => $cart]);

        if ($request->ajax()) {
            $item = $cart[$request->key] ?? null;
            return response()->json([
                'status'     => 1,
                'cart_count' => collect($cart)->sum('quantity'),
                'cart_total' => collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']),
                'item_total' => $item ? $item['price'] * $item['quantity'] : 0,
                'quantity'   => $item['quantity'] ?? 0,
                'price'      => $item['price'] ?? 0,
            ]);
        }

        return redirect()->route('front.cart');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ], ValidationMessageService::getMessages('cart_remove'));

        $cart = session('cart', []);
        unset($cart[$request->key]);
        session(['cart' => $cart]);

        if ($request->ajax()) {
            return response()->json([
                'status'     => 1,
                'cart_count' => collect($cart)->sum('quantity'),
                'cart_total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
                'cart'       => array_values($cart),
            ]);
        }

        return redirect()->route('front.cart');
    }
}

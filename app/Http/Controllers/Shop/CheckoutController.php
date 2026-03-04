<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use App\Models\Shop\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('front.cart')->with('error', 'Sepetiniz boş.');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('front.pages.checkout', compact('cart', 'subtotal'));
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
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('front.cart')->with('error', 'Sepetiniz boş.');
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        DB::transaction(function () use ($request, $cart, $subtotal) {
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
                'total'            => $subtotal,
            ]);

            foreach ($cart as $item) {
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
        });

        session()->forget('cart');

        return redirect()->route('front.products')
            ->with('success', 'Siparişiniz başarıyla alındı! En kısa sürede sizinle iletişime geçeceğiz.');
    }
}

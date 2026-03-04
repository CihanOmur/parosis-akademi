<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use App\Models\Shop\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('front.pages.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'variant_id' => 'nullable|integer|exists:product_variants,id',
            'quantity'   => 'nullable|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($request->product_id);
        $variant = $request->variant_id
            ? ProductVariant::with('attributeValues.attribute')->findOrFail($request->variant_id)
            : null;

        $key = $product->id . '_' . ($variant?->id ?? 0);
        $price = $variant ? ((float) ($variant->price ?? $product->price)) : (float) $product->effective_price;
        $locale = app()->getLocale();

        $variantInfo = [];
        if ($variant) {
            foreach ($variant->attributeValues as $val) {
                $variantInfo[$val->attribute->getTranslation('name', $locale)] = $val->getTranslation('name', $locale);
            }
        }

        $cart = session('cart', []);
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += ($request->quantity ?? 1);
        } else {
            $cart[$key] = [
                'product_id'   => $product->id,
                'variant_id'   => $variant?->id,
                'name'         => $product->getTranslation('name', $locale),
                'variant_info' => $variantInfo,
                'price'        => $price,
                'image'        => $product->image,
                'quantity'     => $request->quantity ?? 1,
            ];
        }
        session(['cart' => $cart]);

        if ($request->ajax()) {
            return response()->json([
                'status'     => 1,
                'message'    => 'Ürün sepete eklendi.',
                'cart_count' => collect($cart)->sum('quantity'),
            ]);
        }

        return redirect()->route('front.cart')->with('success', 'Ürün sepete eklendi.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'key'      => 'required|string',
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        $cart = session('cart', []);

        if ($request->quantity == 0) {
            unset($cart[$request->key]);
        } elseif (isset($cart[$request->key])) {
            $cart[$request->key]['quantity'] = $request->quantity;
        }

        session(['cart' => $cart]);

        return redirect()->route('front.cart');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $cart = session('cart', []);
        unset($cart[$request->key]);
        session(['cart' => $cart]);

        return redirect()->route('front.cart');
    }
}

<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use App\Models\Shop\ProductCategory;

class ShopFrontController extends Controller
{
    public function products()
    {
        $search = trim(request('q', ''));
        $categoryId = request('kategori');

        $query = Product::with('categories')
            ->where('is_active', true);

        if (mb_strlen($search) >= 2) {
            $lower = mb_strtolower($search);
            $query->where(function ($q) use ($lower) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$lower}%"])
                  ->orWhereRaw('LOWER(short_description) LIKE ?', ["%{$lower}%"]);
            });
        }

        if ($categoryId) {
            $query->whereHas('categories', fn($q) => $q->where('product_categories.id', $categoryId));
        }

        $products = $query->orderBy('sort_order')->paginate(9)->appends(request()->only('q', 'kategori'));

        $categories = ProductCategory::where('is_active', true)
            ->withCount(['products' => fn($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();

        return view('front.pages.products', compact('products', 'categories', 'search', 'categoryId'));
    }

    public function productDetails($id)
    {
        $product = Product::with([
            'categories',
            'images',
            'variants' => fn($q) => $q->where('is_active', true)->orderBy('sort_order'),
            'variants.attributeValues.attribute',
        ])->where('is_active', true)->findOrFail($id);

        // Build attribute map for variant selector
        $attributeMap = [];
        foreach ($product->variants as $variant) {
            foreach ($variant->attributeValues as $val) {
                $attrId = $val->product_attribute_id;
                if (!isset($attributeMap[$attrId])) {
                    $attributeMap[$attrId] = [
                        'name'   => $val->attribute->name,
                        'values' => [],
                    ];
                }
                $attributeMap[$attrId]['values'][$val->id] = [
                    'id'         => $val->id,
                    'name'       => $val->name,
                    'color_code' => $val->color_code,
                ];
            }
        }

        // Build variant lookup: "valueId1_valueId2" => {id, price, stock}
        $variantLookup = [];
        foreach ($product->variants as $variant) {
            $valueIds = $variant->attributeValues->pluck('id')->sort()->values()->implode('_');
            $variantLookup[$valueIds] = [
                'id'    => $variant->id,
                'price' => (float) ($variant->price ?? $product->price),
                'stock' => $variant->stock,
                'sku'   => $variant->sku,
                'image' => $variant->image ? asset($variant->image) : null,
            ];
        }

        $relatedProducts = Product::with('categories')
            ->where('is_active', true)
            ->where('id', '!=', $id)
            ->whereHas('categories', fn($q) => $q->whereIn('product_categories.id', $product->categories->pluck('id')))
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('front.pages.product-details', compact(
            'product', 'attributeMap', 'variantLookup', 'relatedProducts'
        ));
    }
}

<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use App\Models\Shop\ProductAttribute;
use App\Models\Shop\ProductCategory;
use App\Models\Shop\ProductImage;
use App\Models\Shop\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->orderBy('sort_order')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
            'description'       => 'nullable|string',
            'features'          => 'nullable|string',
            'sku'               => 'nullable|string|max:100|unique:products,sku',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'stock'             => 'nullable|integer|min:0',
            'image'             => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:2048',
        ]);

        $locale = app()->getLocale();
        $product = new Product();

        $product->setTranslation('name', $locale, $request->name);
        if ($request->filled('short_description')) {
            $product->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->filled('description')) {
            $product->setTranslation('description', $locale, $request->description);
        }
        if ($request->filled('features')) {
            $product->setTranslation('features', $locale, $request->features);
        }

        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock ?? 0;
        $product->manage_stock = $request->has('manage_stock');
        $product->sort_order = Product::max('sort_order') + 1;
        $product->is_active = true;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $product->image = 'uploads/products/' . $filename;
        }

        $product->save();
        $product->categories()->sync($request->category_ids ?? []);

        // Gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $i => $file) {
                $filename = time() . '_' . $i . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products'), $filename);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => 'uploads/products/' . $filename,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('products.edit', $product->id)
            ->with('success', 'Ürün başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $product = Product::with(['categories', 'images', 'variants.attributeValues.attribute'])->findOrFail($id);
        $categories = ProductCategory::where('is_active', true)->orderBy('sort_order')->get();
        $attributes = ProductAttribute::with(['values' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('admin.products.edit', compact('product', 'categories', 'attributes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
            'description'       => 'nullable|string',
            'features'          => 'nullable|string',
            'sku'               => 'nullable|string|max:100|unique:products,sku,' . $id,
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'stock'             => 'nullable|integer|min:0',
            'image'             => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $locale = app()->getLocale();

        $product->setTranslation('name', $locale, $request->name);
        $product->setTranslation('short_description', $locale, $request->short_description ?? '');
        $product->setTranslation('description', $locale, $request->description ?? '');
        $product->setTranslation('features', $locale, $request->features ?? '');

        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock ?? 0;
        $product->manage_stock = $request->has('manage_stock');

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $product->image = 'uploads/products/' . $filename;
        }

        $product->save();
        $product->categories()->sync($request->category_ids ?? []);

        return redirect()->route('products.edit', $id)
            ->with('success', 'Ürün başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Ürün silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:products,id',
        ]);

        foreach ($request->order as $index => $id) {
            Product::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json([
            'status'  => 1,
            'message' => $product->is_active ? 'Ürün aktif edildi.' : 'Ürün pasif edildi.',
            'action'  => $product->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $product = Product::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.products.edit-translate', compact('product', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
            'description'       => 'nullable|string',
            'features'          => 'nullable|string',
            'lang'              => 'required|string',
        ]);

        $product = Product::findOrFail($id);
        $locale = $request->lang;

        $product->setTranslation('name', $locale, $request->name);
        $product->setTranslation('short_description', $locale, $request->short_description ?? '');
        $product->setTranslation('description', $locale, $request->description ?? '');
        $product->setTranslation('features', $locale, $request->features ?? '');
        $product->save();

        return redirect()->route('products.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }

    // --- Variant Management ---

    public function generateVariants(Request $request, $id)
    {
        $request->validate([
            'attribute_ids'   => 'required|array|min:1',
            'attribute_ids.*' => 'integer|exists:product_attributes,id',
        ]);

        $product = Product::findOrFail($id);
        $attributes = ProductAttribute::with(['values' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->whereIn('id', $request->attribute_ids)
            ->get();

        // Cartesian product
        $combinations = [[]];
        foreach ($attributes as $attr) {
            $newCombinations = [];
            foreach ($combinations as $existing) {
                foreach ($attr->values as $value) {
                    $newCombinations[] = array_merge($existing, [$value->id]);
                }
            }
            $combinations = $newCombinations;
        }

        $created = 0;
        foreach ($combinations as $valueIds) {
            sort($valueIds);

            // Check if variant with these exact values already exists
            $exists = $product->variants()
                ->whereHas('attributeValues', fn($q) => $q->whereIn('product_attribute_values.id', $valueIds), '=', count($valueIds))
                ->get()
                ->filter(function ($variant) use ($valueIds) {
                    $existingIds = $variant->attributeValues->pluck('id')->sort()->values()->toArray();
                    return $existingIds === $valueIds;
                })
                ->isNotEmpty();

            if (!$exists) {
                // Build SKU from product SKU + value names
                $valueModels = \App\Models\Shop\ProductAttributeValue::whereIn('id', $valueIds)->orderBy('sort_order')->get();
                $skuSuffix = $valueModels->map(fn($v) => mb_strtoupper(mb_substr($v->name, 0, 3)))->join('-');
                $autoSku = $product->sku ? $product->sku . '-' . $skuSuffix : null;

                $variant = $product->variants()->create([
                    'sku'        => $autoSku,
                    'price'      => $product->price,
                    'sort_order' => ProductVariant::where('product_id', $product->id)->max('sort_order') + 1,
                    'stock'      => 0,
                    'is_active'  => true,
                ]);
                $variant->attributeValues()->attach($valueIds);
                $created++;
            }
        }

        $product->load('variants.attributeValues.attribute');

        return response()->json([
            'status'  => 1,
            'message' => $created . ' yeni varyant oluşturuldu.',
            'created' => $created,
        ]);
    }

    public function updateVariants(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $variants = $request->input('variants', []);
        foreach ($variants as $variantId => $data) {
            $variant = ProductVariant::where('id', $variantId)->where('product_id', $product->id)->first();
            if ($variant) {
                $variant->sku = $data['sku'] ?? null;
                $variant->price = !empty($data['price']) ? $data['price'] : null;
                $variant->stock = $data['stock'] ?? 0;
                $variant->is_active = !empty($data['is_active']) && $data['is_active'] !== '0';
                $variant->save();
            }
        }

        return response()->json(['status' => 1, 'message' => 'Varyantlar güncellendi.']);
    }

    public function deleteVariant($variantId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        $variant->delete();

        return response()->json(['status' => 1, 'message' => 'Varyant silindi.']);
    }

    // --- Gallery ---

    public function uploadGallery(Request $request, $id)
    {
        $request->validate([
            'images'   => 'required|array',
            'images.*' => 'file|mimes:png,jpg,jpeg,webp,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $images = [];

        foreach ($request->file('images') as $i => $file) {
            $filename = time() . '_' . $i . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $img = ProductImage::create([
                'product_id' => $product->id,
                'image'      => 'uploads/products/' . $filename,
                'sort_order' => ProductImage::where('product_id', $product->id)->max('sort_order') + 1,
            ]);
            $images[] = $img;
        }

        return response()->json(['status' => 1, 'message' => 'Resimler yüklendi.', 'images' => $images]);
    }

    public function deleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        if (file_exists(public_path($image->image))) {
            unlink(public_path($image->image));
        }
        $image->delete();

        return response()->json(['status' => 1, 'message' => 'Resim silindi.']);
    }

    public function updateImageOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:product_images,id',
        ]);

        foreach ($request->order as $index => $id) {
            ProductImage::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }
}

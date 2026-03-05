<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\ProductAttribute;
use App\Models\Shop\ProductAttributeValue;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index()
    {
        $attributes = ProductAttribute::withCount('values')->orderBy('sort_order')->get();
        return view('admin.product-attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.product-attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $locale = app()->getLocale();

        $attribute = new ProductAttribute();
        $attribute->setTranslation('name', $locale, $request->name);
        $attribute->sort_order = ProductAttribute::max('sort_order') + 1;
        $attribute->is_active = true;
        $attribute->save();

        return redirect()->route('productAttributes.edit', $attribute->id)
            ->with('success', 'Nitelik oluşturuldu. Şimdi değerler ekleyebilirsiniz.');
    }

    public function edit($id)
    {
        $attribute = ProductAttribute::with(['values' => fn($q) => $q->orderBy('sort_order')])->findOrFail($id);
        return view('admin.product-attributes.edit', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $attribute = ProductAttribute::findOrFail($id);
        $locale = app()->getLocale();

        $attribute->setTranslation('name', $locale, $request->name);
        $attribute->save();

        return redirect()->route('productAttributes.edit', $id)
            ->with('success', 'Nitelik güncellendi.');
    }

    public function delete($id)
    {
        $attribute = ProductAttribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('productAttributes.index')
            ->with('success', 'Nitelik silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:product_attributes,id',
        ]);

        foreach ($request->order as $index => $id) {
            ProductAttribute::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $attribute = ProductAttribute::findOrFail($id);
        $attribute->is_active = !$attribute->is_active;
        $attribute->save();

        return response()->json([
            'status'  => 1,
            'message' => $attribute->is_active ? 'Nitelik aktif edildi.' : 'Nitelik pasif edildi.',
            'action'  => $attribute->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $attribute = ProductAttribute::with(['values' => fn($q) => $q->orderBy('sort_order')])->findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.product-attributes.edit-translate', compact('attribute', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:200',
            'lang'          => 'required|string',
            'values'        => 'nullable|array',
            'values.*.name' => 'nullable|string|max:200',
        ]);

        $attribute = ProductAttribute::findOrFail($id);
        $locale = $request->lang;

        $attribute->setTranslation('name', $locale, $request->name);
        $attribute->save();

        if ($request->values) {
            foreach ($request->values as $valueId => $valueData) {
                $value = ProductAttributeValue::where('id', $valueId)
                    ->where('product_attribute_id', $attribute->id)
                    ->first();
                if ($value && !empty($valueData['name'])) {
                    $value->setTranslation('name', $locale, $valueData['name']);
                    $value->save();
                }
            }
        }

        return redirect()->route('productAttributes.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }

    // --- Attribute Values ---

    public function storeValue(Request $request, $id)
    {
        $request->validate([
            'value_name'  => 'required|string|max:200',
            'color_code'  => 'nullable|string|max:20',
        ]);

        $attribute = ProductAttribute::findOrFail($id);
        $locale = app()->getLocale();

        $value = new ProductAttributeValue();
        $value->product_attribute_id = $attribute->id;
        $value->setTranslation('name', $locale, $request->value_name);
        $value->color_code = $request->color_code;
        $value->sort_order = ProductAttributeValue::where('product_attribute_id', $attribute->id)->max('sort_order') + 1;
        $value->is_active = true;
        $value->save();

        if ($request->ajax()) {
            return response()->json(['status' => 1, 'message' => 'Değer eklendi.', 'value' => [
                'id' => $value->id,
                'name' => $value->name,
                'color_code' => $value->color_code,
                'is_active' => (bool) $value->is_active,
            ]]);
        }

        return redirect()->route('productAttributes.edit', $id)
            ->with('success', 'Değer eklendi.');
    }

    public function updateValue(Request $request, $valueId)
    {
        $request->validate([
            'value_name' => 'required|string|max:200',
            'color_code' => 'nullable|string|max:20',
        ]);

        $value = ProductAttributeValue::findOrFail($valueId);
        $locale = app()->getLocale();

        $value->setTranslation('name', $locale, $request->value_name);
        $value->color_code = $request->color_code;
        $value->save();

        if ($request->ajax()) {
            return response()->json(['status' => 1, 'message' => 'Değer güncellendi.']);
        }

        return redirect()->route('productAttributes.edit', $value->product_attribute_id)
            ->with('success', 'Değer güncellendi.');
    }

    public function deleteValue($valueId)
    {
        $value = ProductAttributeValue::findOrFail($valueId);
        $attributeId = $value->product_attribute_id;
        $value->delete();

        if (request()->ajax()) {
            return response()->json(['status' => 1, 'message' => 'Değer silindi.']);
        }

        return redirect()->route('productAttributes.edit', $attributeId)
            ->with('success', 'Değer silindi.');
    }

    public function toggleValue($valueId)
    {
        $value = ProductAttributeValue::findOrFail($valueId);
        $value->is_active = !$value->is_active;
        $value->save();

        return response()->json([
            'status'  => 1,
            'message' => $value->is_active ? 'Değer aktif edildi.' : 'Değer pasif edildi.',
            'action'  => $value->is_active ? 'Aktif' : 'Pasif',
        ]);
    }
}

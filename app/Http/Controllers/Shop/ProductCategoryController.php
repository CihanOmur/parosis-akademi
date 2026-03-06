<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\ProductCategory;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('sort_order')->get();
        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:200',
            'image' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ], ValidationMessageService::getMessages('product_cat_store'));

        $locale = app()->getLocale();

        $category = new ProductCategory();
        $category->setTranslation('name', $locale, $request->name);
        $category->sort_order = ProductCategory::max('sort_order') + 1;
        $category->is_active = true;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/product-categories'), $filename);
            $category->image = 'uploads/product-categories/' . $filename;
        }

        $category->save();

        return redirect()->route('productCategories.index')
            ->with('success', 'Ürün kategorisi başarıyla eklendi.');
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('admin.product-categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:200',
            'image' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ], ValidationMessageService::getMessages('product_cat_update'));

        $category = ProductCategory::findOrFail($id);
        $locale = app()->getLocale();

        $category->setTranslation('name', $locale, $request->name);

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/product-categories'), $filename);
            $category->image = 'uploads/product-categories/' . $filename;
        }

        $category->save();

        return redirect()->route('productCategories.index')
            ->with('success', 'Ürün kategorisi başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('productCategories.index')
            ->with('success', 'Ürün kategorisi silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:product_categories,id',
        ], ValidationMessageService::getMessages('product_cat_order'));

        foreach ($request->order as $index => $id) {
            ProductCategory::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->is_active = !$category->is_active;
        $category->save();

        return response()->json([
            'status'  => 1,
            'message' => $category->is_active ? 'Kategori aktif edildi.' : 'Kategori pasif edildi.',
            'action'  => $category->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $category = ProductCategory::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.product-categories.edit-translate', compact('category', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'lang' => 'required|string',
        ], ValidationMessageService::getMessages('product_cat_translate'));

        $category = ProductCategory::findOrFail($id);
        $locale = $request->lang;

        $category->setTranslation('name', $locale, $request->name);
        $category->save();

        return redirect()->route('productCategories.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}

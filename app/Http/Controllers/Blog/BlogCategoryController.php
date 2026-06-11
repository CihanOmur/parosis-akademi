<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blogs\BlogCategory;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::orderBy('sort_order')->get();
        return view('admin.blog.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:200',
            'description' => 'nullable|string|max:5000',
            'image'       => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], ValidationMessageService::getMessages('blog_cat_store'));

        $locale = app()->getLocale();

        $category = new BlogCategory();
        $category->setTranslation('name', $locale, $request->name);

        if ($request->filled('description')) {
            $category->setTranslation('description', $locale, $request->description);
        }

        if ($request->hasFile('image')) {
            $category->image = $this->saveImage($request->file('image'));
        }

        $category->sort_order = BlogCategory::max('sort_order') + 1;
        $category->is_active = true;
        $category->save();

        return redirect()->route('blogCategories.index')
            ->with('success', 'Blog kategorisi başarıyla eklendi.');
    }

    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:200',
            'description' => 'nullable|string|max:5000',
            'image'       => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], ValidationMessageService::getMessages('blog_cat_update'));

        $category = BlogCategory::findOrFail($id);
        $locale = app()->getLocale();

        $category->setTranslation('name', $locale, $request->name);

        if ($request->has('description')) {
            $category->setTranslation('description', $locale, $request->description ?? '');
        }

        if ($request->hasFile('image')) {
            $category->image = $this->saveImage($request->file('image'));
        }

        $category->save();

        return redirect()->route('blogCategories.index')
            ->with('success', 'Blog kategorisi başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('blogCategories.index')
            ->with('success', 'Blog kategorisi silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:blog_categories,id',
        ], ValidationMessageService::getMessages('blog_cat_order'));

        foreach ($request->order as $index => $id) {
            BlogCategory::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $category = BlogCategory::findOrFail($id);
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
        $category = BlogCategory::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.blog.categories.edit-translate', compact('category', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:200',
            'description' => 'nullable|string|max:5000',
            'lang'        => 'required|string',
        ], ValidationMessageService::getMessages('blog_cat_translate'));

        $category = BlogCategory::findOrFail($id);
        $locale = $request->lang;

        $category->setTranslation('name', $locale, $request->name);

        if ($request->has('description')) {
            $category->setTranslation('description', $locale, $request->description ?? '');
        }

        $category->save();

        return redirect()->route('blogCategories.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }

    private function saveImage($file): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $dir = public_path('uploads/blog-categories');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $file->move($dir, $filename);
        return 'uploads/blog-categories/' . $filename;
    }
}

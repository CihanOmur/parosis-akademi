<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Blogs\Blog;
use App\Models\Blogs\BlogCategories;
use App\Models\Category\Category;
use App\Models\Languages\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::with('categories')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("title->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->paginate(10);

        return view('admin.blogs.index', [
            'blogs' => $blogs,
        ]);
    }
    public function create(Request $request)
    {
        $categories = Category::where('model', 'Blogs')->where('is_active', true)->get();
        return view('admin.blogs.create', [
            'categories' => $categories
        ]);
    }
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
                'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'description.required' => 'Açıklama alanı gereklidir.',
                'description.string' => 'Açıklama alanı metin olmalıdır.',
                'description.max' => 'Açıklama alanı en fazla 500 karakter olmalıdır.',
                'categories.required' => 'Kategori alanı gereklidir.',
                'categories.array' => 'Kategori alanı bir dizi olmalıdır.',
                'categories.*.exists' => 'Seçilen kategori geçerli değil.',
                'file.required' => 'Dosya alanı gereklidir.',
                'file.file' => 'Dosya alanı geçerli bir dosya olmalıdır.',
                'file.mimes' => 'Dosya alanı yalnızca jpg, jpeg ve png uzantılı dosyaları kabul etmektedir.',
                'file.max' => 'Dosya alanı en fazla 2MB boyutunda olmalıdır.',
            ]
        );

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('blogs', $filename, 'public');
            $blog->image_url = $filename;
        }
        $blog->save();
        if ($request->has('categories')) {
            foreach ($request->categories as $categoryId) {
                $BlogCategories = new BlogCategories();
                $BlogCategories->blog_id = $blog->id;
                $BlogCategories->category_id = $categoryId;
                $BlogCategories->save();
            }
        }
        return redirect()->route('blogs.index')->with('success', 'Blog başarıyla eklendi.');
    }

    public function editTranslate($id)
    {
        $blog = Blog::with(['categories'])->findOrFail($id);
        return view('admin.blogs.translate', [
            'blog' => $blog,
        ]);
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'description.required' => 'Açıklama alanı gereklidir.',
                'description.string' => 'Açıklama alanı metin olmalıdır.',
                'description.max' => 'Açıklama alanı en fazla 500 karakter olmalıdır.',
            ]
        );

        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();
        $blog = Blog::findOrFail($id);
        $blog->setTranslation('title', $translateLang, $request->title);
        $blog->setTranslation('description', $translateLang, $request->description);
        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'Blog başarıyla güncellendi.');
    }
    public function edit($id)
    {
        $blog = Blog::with(['categories'])->findOrFail($id);
        $categories = Category::where('model', 'Blogs')->where('is_active', true)->get();
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
                'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'description.required' => 'Açıklama alanı gereklidir.',
                'description.string' => 'Açıklama alanı metin olmalıdır.',
                'description.max' => 'Açıklama alanı en fazla 500 karakter olmalıdır.',
                'categories.required' => 'Kategori alanı gereklidir.',
                'categories.*.exists' => 'Seçilen kategori geçerli değil.',
                'file.file' => 'Dosya alanı geçerli bir dosya olmalıdır.',
                'file.mimes' => 'Dosya alanı yalnızca jpg, jpeg ve png uzantılı dosyaları kabul etmektedir.',
                'file.max' => 'Dosya alanı en fazla 2MB boyutunda olmalıdır.',
            ]
        );

        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();
        $blog = Blog::findOrFail($id);
        $blog->setTranslation('title', $translateLang, $request->title);
        $blog->setTranslation('description', $translateLang, $request->description);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('blogs', $filename, 'public');
            $blog->image_url = $filename;
        }

        $blog->save();
        if ($request->has('categories')) {
            BlogCategories::where('blog_id', $blog->id)->delete();
            foreach ($request->categories as $categoryId) {
                $BlogCategories = new BlogCategories();
                $BlogCategories->blog_id = $blog->id;
                $BlogCategories->category_id = $categoryId;
                $BlogCategories->save();
            }
        }
        return redirect()->route('blogs.index')->with('success', 'Blog başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image_url) {
            // Delete the image file if it exists
            $imagePath = public_path('storage/blogs/' . $blog->image_url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog başarıyla silindi.');
    }

    public function categoryIndex(Request $request)
    {
        $categories = Category::where('model', 'Blogs')->withCount('blogs')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();

        return view('admin.blogs.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $category = new Category();
        $category->name = $request->title;
        $category->description = $request->description;
        $category->slug = $this->generateSlug($request->title);
        $category->is_active = true;
        $category->model = 'Blogs';
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('blogs.categories.index')->with('success', 'Category created successfully.');
    }

    public function categoryEdit(Request $request, $id)
    {
        $languageData = getLocaleInfo($request->lang);

        $category = Category::where('id', $id)->where('model', 'Blogs')->first();
        if (!$category) {
            return redirect()->route('blogs.categories.index')->with('error', 'Category not found.');
        }
        $categories = Category::where('model', 'Blogs')->withCount('blogs')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.blogs.categories.edit', [
            'selectedLanguage' => $languageData['selectedLanguage'] ?? null,
            'translateLang' => $languageData['translateLang'] ?? null,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $category = Category::where('id', $id)->where('model', 'Blogs')->first();
        if (!$category) {
            return redirect()->route('blogs.categories.index')->with('error', 'Category not found.');
        }

        $category->setTranslation('name', $translateLang, $request->title);
        $category->setTranslation('description', $translateLang, $request->description);
        $category->slug = $this->generateSlug($request->title, $id);
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('teams.departments.index')->with('success', 'Department updated successfully.');
    }
    public function categoryEditTranslate(Request $request, $id)
    {
        $languageData = getLocaleInfo($request->lang);

        $category = Category::where('id', $id)->where('model', 'Blogs')->first();
        if (!$category) {
            return redirect()->route('blogs.categories.index')->with('error', 'Category not found.');
        }
        $categories = Category::where('model', 'Blogs')->withCount('blogs')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.blogs.categories.translate', [
            'selectedLanguage' => $languageData['selectedLanguage'] ?? null,
            'translateLang' => $languageData['translateLang'] ?? null,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    public function categoryUpdateTranslate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $category = Category::where('id', $id)->where('model', 'Blogs')->first();
        if (!$category) {
            return redirect()->route('blogs.categories.index')->with('error', 'Category not found.');
        }

        $category->setTranslation('name', $translateLang, $request->title);
        $category->setTranslation('description', $translateLang, $request->description);
        $category->save();

        return redirect()->route('teams.departments.index')->with('success', 'Department updated successfully.');
    }

    public function categoryDelete($id)
    {
        $category = Category::where('id', $id)->where('model', 'Blogs')->first();
        if (!$category) {
            return redirect()->route('blogs.categories.index')->with('error', 'Category not found.');
        }

        $category->delete();

        return redirect()->route('blogs.categories.index')->with('success', 'Category deleted successfully.');
    }

    public function generateSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $count = Category::where('slug', 'like', $slug . '%')->when($id, function ($query) use ($id) {
            return $query->where('id', '!=', $id);
        })->count();

        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        return $slug;
    }
}

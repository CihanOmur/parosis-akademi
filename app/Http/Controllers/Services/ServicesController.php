<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Service\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $services = Services::with('category')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("title->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->paginate(10);

        return view('admin.services.index', [
            'services' => $services,
        ]);
    }
    public function create(Request $request)
    {
        $categories = Category::where('model', 'Services')->where('is_active', true)->get();
        return view('admin.services.create', [
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'category' => 'required|exists:categories,id',
                'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'description.required' => 'Açıklama alanı gereklidir.',
                'description.string' => 'Açıklama alanı metin olmalıdır.',
                'description.max' => 'Açıklama alanı en fazla 500 karakter olmalıdır.',
                'category.required' => 'Kategori alanı gereklidir.',
                'category.exists' => 'Seçilen kategori geçerli değil.',
                'file.required' => 'Dosya alanı gereklidir.',
                'file.file' => 'Dosya alanı geçerli bir dosya olmalıdır.',
                'file.mimes' => 'Dosya alanı yalnızca jpg, jpeg ve png uzantılı dosyaları kabul etmektedir.',
                'file.max' => 'Dosya alanı en fazla 2MB boyutunda olmalıdır.',
            ]
        );

        $service = new Services();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->category_id = $request->category;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('services', $filename, 'public');
            $service->image_url = $filename;
        }
        $service->save();

        return redirect()->route('services.index')->with('success', 'Hizmet başarıyla eklendi.');
    }

    public function editTranslate($id)
    {
        $service = Services::with(['category'])->findOrFail($id);
        $categories = Category::where('model', 'Departments')->where('is_active', true)->get();
        return view('admin.services.translate', [
            'service' => $service,
            'categories' => $categories
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

        $service = Services::findOrFail($id);
        $service->setTranslation('title', $translateLang, $request->title);
        $service->setTranslation('description', $translateLang, $request->description);
        $service->save();

        return redirect()->route('services.index')->with('success', 'Hizmet başarıyla güncellendi.');
    }
    public function edit($id)
    {
        $service = Services::with(['category'])->findOrFail($id);
        $categories = Category::where('model', 'Departments')->where('is_active', true)->get();
        return view('admin.services.edit', [
            'service' => $service,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'category' => 'required|exists:categories,id',
                'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'description.required' => 'Açıklama alanı gereklidir.',
                'description.string' => 'Açıklama alanı metin olmalıdır.',
                'description.max' => 'Açıklama alanı en fazla 500 karakter olmalıdır.',
                'category.required' => 'Kategori alanı gereklidir.',
                'category.exists' => 'Seçilen kategori geçerli değil.',
                'file.file' => 'Dosya alanı geçerli bir dosya olmalıdır.',
                'file.mimes' => 'Dosya alanı yalnızca jpg, jpeg ve png uzantılı dosyaları kabul etmektedir.',
                'file.max' => 'Dosya alanı en fazla 2MB boyutunda olmalıdır.',
            ]
        );
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $service = Services::findOrFail($id);
        $service->setTranslation('title', $translateLang, $request->title);
        $service->setTranslation('description', $translateLang, $request->description);
        $service->category_id = $request->category;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('services', $filename, 'public');
            $service->image_url = $filename;
        }

        $service->save();

        return redirect()->route('services.index')->with('success', 'Hizmet başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $service = Services::findOrFail($id);
        if ($service->image_url) {
            // Delete the image file if it exists
            $imagePath = public_path('storage/services/' . $service->image_url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Hizmet başarıyla silindi.');
    }

    public function categoryIndex(Request $request)
    {
        $categories = Category::where('model', 'Services')->withCount('services')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.services.categories.index', [
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
        $category->model = 'Services';
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('services.categories.index')->with('success', 'Category created successfully.');
    }

    public function categoryEditTranslate(Request $request, $id)
    {
        $category = Category::where('id', $id)->where('model', 'Services')->first();
        if (!$category) {
            return redirect()->route('services.categories.index')->with('error', 'Category not found.');
        }
        $categories = Category::where('model', 'Services')->withCount('services')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.services.categories.translate', [
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

        $category = Category::where('id', $id)->where('model', 'Services')->first();
        if (!$category) {
            return redirect()->route('services.categories.index')->with('error', 'Category not found.');
        }

        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $category->setTranslation('name', $translateLang, $request->title);
        $category->setTranslation('description', $translateLang, $request->description);
        $category->save();

        return redirect()->route('services.categories.index')->with('success', 'Department updated successfully.');
    }
    public function categoryEdit(Request $request, $id)
    {
        $category = Category::where('id', $id)->where('model', 'Services')->first();
        if (!$category) {
            return redirect()->route('services.categories.index')->with('error', 'Category not found.');
        }
        $categories = Category::where('model', 'Services')->withCount('services')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.services.categories.edit', [
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

        $category = Category::where('id', $id)->where('model', 'Services')->first();
        if (!$category) {
            return redirect()->route('services.categories.index')->with('error', 'Category not found.');
        }

        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $category->setTranslation('name', $translateLang, $request->title);
        $category->setTranslation('description', $translateLang, $request->description);
        $category->slug = $this->generateSlug($request->title, $id);
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('teams.departments.index')->with('success', 'Department updated successfully.');
    }

    public function categoryDelete($id)
    {
        $category = Category::where('id', $id)->where('model', 'Services')->first();
        if (!$category) {
            return redirect()->route('services.categories.index')->with('error', 'Category not found.');
        }

        $category->delete();

        return redirect()->route('services.categories.index')->with('success', 'Category deleted successfully.');
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

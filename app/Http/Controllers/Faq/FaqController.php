<?php

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Faq\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::with('category')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("question->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->paginate(10);

        return view('admin.faq.index', [
            'faqs' => $faqs,
        ]);
    }
    public function create(Request $request)
    {
        $categories = Category::where('model', 'Faq')->where('is_active', true)->get();
        return view('admin.faq.create', [
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {

        $request->validate(
            [
                'question' => 'required|string|max:255',
                'answer' => 'required|string|max:500',
                'category' => 'required|exists:categories,id',
            ],
            [
                'question.required' => 'Soru alanı gereklidir.',
                'question.string' => 'Soru alanı metin olmalıdır.',
                'question.max' => 'Soru alanı en fazla 255 karakter olmalıdır.',
                'answer.required' => 'Cevap alanı gereklidir.',
                'answer.string' => 'Cevap alanı metin olmalıdır.',
                'answer.max' => 'Cevap alanı en fazla 500 karakter olmalıdır.',
                'category.required' => 'Kategori alanı gereklidir.',
                'category.exists' => 'Seçilen kategori geçerli değil.',
            ]
        );

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->category_id = $request->category;
        $faq->save();

        return redirect()->route('faq.index')->with('success', 'SSS başarıyla eklendi.');
    }



    public function editTranslate($id)
    {
        $faq = Faq::with(['category'])->findOrFail($id);
        return view('admin.faq.translate', [
            'faq' => $faq,
        ]);
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate(
            [
                'question' => 'required|string|max:255',
                'answer' => 'required|string|max:500',
            ],
            [
                'question.required' => 'question alanı gereklidir.',
                'question.string' => 'question alanı metin olmalıdır.',
                'question.max' => 'question alanı en fazla 255 karakter olmalıdır.',
                'answer.required' => 'answer alanı gereklidir.',
                'answer.string' => 'answer alanı metin olmalıdır.',
                'answer.max' => 'answer alanı en fazla 500 karakter olmalıdır.',

            ]
        );
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();
        $faq = Faq::findOrFail($id);
        $faq->setTranslation('question', $translateLang, $request->question);
        $faq->setTranslation('answer', $translateLang, $request->answer);
        $faq->save();

        return redirect()->route('faq.index')->with('success', 'Hizmet başarıyla güncellendi.');
    }
    public function edit($id)
    {
        $faq = Faq::with(['category'])->findOrFail($id);
        $categories = Category::where('model', 'Faq')->where('is_active', true)->get();
        return view('admin.faq.edit', [
            'faq' => $faq,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'question' => 'required|string|max:255',
                'answer' => 'required|string|max:500',
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
        $faq = Faq::findOrFail($id);
        $faq->setTranslation('question', $translateLang, $request->question);
        $faq->setTranslation('answer', $translateLang, $request->answer);
        $faq->category_id = $request->category;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('faq', $filename, 'public');
            $faq->image_url = $filename;
        }

        $faq->save();

        return redirect()->route('faq.index')->with('success', 'Hizmet başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $faq = Faq::findOrFail($id);
        if ($faq->image_url) {
            // Delete the image file if it exists
            $imagePath = public_path('storage/faq/' . $faq->image_url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $faq->delete();

        return redirect()->route('faq.index')->with('success', 'SSS başarıyla silindi.');
    }

    public function categoryIndex(Request $request)
    {
        $categories = Category::where('model', 'Faq')->withCount('faqs')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.faq.categories.index', [
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
        $category->model = 'Faq';
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('faq.categories.index')->with('success', 'Category created successfully.');
    }

    public function categoryEditTranslate(Request $request, $id)
    {
        $category = Category::where('id', $id)->where('model', 'Faq')->first();
        if (!$category) {
            return redirect()->route('faq.categories.index')->with('error', 'Category not found.');
        }
        $categories = Category::where('model', 'Faq')->withCount('faqs')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.faq.categories.translate', [
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

        $category = Category::where('id', $id)->where('model', 'Faq')->first();
        if (!$category) {
            return redirect()->route('faq.categories.index')->with('error', 'Category not found.');
        }
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $category->setTranslation('name', $translateLang, $request->title);
        $category->setTranslation('description', $translateLang, $request->description);
        $category->save();

        return redirect()->route('faq.categories.index')->with('success', 'Department updated successfully.');
    }
    public function categoryEdit(Request $request, $id)
    {
        $category = Category::where('id', $id)->where('model', 'Faq')->first();
        if (!$category) {
            return redirect()->route('faq.categories.index')->with('error', 'Category not found.');
        }
        $categories = Category::where('model', 'Faq')->withCount('faqs')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.faq.categories.edit', [
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

        $category = Category::where('id', $id)->where('model', 'Faq')->first();
        if (!$category) {
            return redirect()->route('faq.categories.index')->with('error', 'Category not found.');
        }
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $category->setTranslation('name', $translateLang, $request->title);
        $category->setTranslation('description', $translateLang, $request->description);
        $category->slug = $this->generateSlug($request->title, $id);
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('faq.categories.index')->with('success', 'Department updated successfully.');
    }

    public function categoryDelete($id)
    {
        $category = Category::where('id', $id)->where('model', 'Faq')->first();
        if (!$category) {
            return redirect()->route('faq.categories.index')->with('error', 'Category not found.');
        }

        $category->delete();

        return redirect()->route('faq.categories.index')->with('success', 'Category deleted successfully.');
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

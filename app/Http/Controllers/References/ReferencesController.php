<?php

namespace App\Http\Controllers\References;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\References\References;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReferencesController extends Controller
{
    public function index(Request $request)
    {
        $references = References::get();

        return view('admin.references.index', [
            'references' => $references,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::where('model', 'References')->where('is_active', true)->get();
        return view('admin.references.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'exists:categories,id'],
            'reference_type' => ['required', 'string', 'in:customer,partner'],
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ], [
            'title.required' => 'Başlık alanı gereklidir.',
            'category.required' => 'Sektör alanı gereklidir.',
            'category.exists' => 'Seçilen sektör geçersiz.',
            'reference_type.required' => 'Referans türü alanı gereklidir.',
            'file.required' => 'Dosya alanı gereklidir.',
            'file.mimes' => 'Dosya tipi jpg, jpeg, png veya pdf olmalıdır.',
            'file.max' => 'Dosya boyutu 2MB\'dan az olmalıdır.',
        ]);

        $reference = new References();
        $reference->name = $request->title;
        $reference->category_id = $request->category;
        $reference->reference_type = $request->reference_type;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('references', $filename, 'public');
            $reference->image_url = $filename;
        }

        $reference->save();

        return redirect()->route('references.index')->with('success', 'Referans başarıyla eklendi.');
    }

    public function editTranslate(Request $request, $id)
    {
        $reference = References::findOrFail($id);
        $categories = Category::where('model', 'References')->where('is_active', true)->get();

        return view('admin.references.translate', [
            'reference' => $reference,
            'categories' => $categories,
        ]);
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ], [
            'title.required' => 'Başlık alanı gereklidir.',
        ]);

        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();
        $reference = References::findOrFail($id);
        $reference->setTranslation('name', $translateLang, $request->title);
        $reference->save();

        return redirect()->route('references.index')->with('success', 'Referans başarıyla güncellendi.');
    }
    public function edit(Request $request, $id)
    {
        $reference = References::findOrFail($id);
        $categories = Category::where('model', 'References')->where('is_active', true)->get();

        return view('admin.references.edit', [
            'reference' => $reference,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'exists:categories,id'],
            'reference_type' => ['required', 'string', 'in:customer,partner'],
            'file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ], [
            'title.required' => 'Başlık alanı gereklidir.',
            'category.required' => 'Sektör alanı gereklidir.',
            'category.exists' => 'Seçilen sektör geçersiz.',
            'reference_type.required' => 'Referans türü alanı gereklidir.',
            'file.mimes' => 'Dosya tipi jpg, jpeg, png veya pdf olmalıdır.',
            'file.max' => 'Dosya boyutu 2MB\'dan az olmalıdır.',
        ]);

        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();
        $reference = References::findOrFail($id);
        $reference->setTranslation('name', $translateLang, $request->title);
        $reference->category_id = $request->category;
        $reference->reference_type = $request->reference_type;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('references', $filename, 'public');
            $reference->image_url = $filename;
        }

        $reference->save();

        return redirect()->route('references.index')->with('success', 'Referans başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $reference = References::findOrFail($id);
        $reference->delete();

        return redirect()->route('references.index')->with('success', 'Referans başarıyla silindi.');
    }

    public function sectorsIndex(Request $request)
    {
        $sectors = Category::where('model', 'References')->withCount('references')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.references.sectors.index', [
            'sectors' => $sectors,
        ]);
    }

    public function sectorsStore(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:160'],
        ], [
            'title.required' => 'Sektör adı alanı gereklidir.',
            'description.required' => 'Açıklama alanı gereklidir.',
            'description.max' => 'Açıklama en fazla 160 karakter olmalıdır.',
        ]);

        $sector = new Category();
        $sector->name = $request->title;
        $sector->description = $request->description;
        $sector->slug = $this->generateSlug($request->title);
        $sector->is_active = true;
        $sector->model = 'References';

        $sector->save();
        return redirect()->route('references.sectors.index')->with('success', 'Sektör başarıyla eklendi.');
    }

    public function sectorsEditTranslate(Request $request, $id)
    {
        $sector = Category::where('id', $id)->where('model', 'References')->first();
        if (!$sector) {
            return redirect()->route('references.sectors.index')->with('error', 'Sektör bulunamadı.');
        }
        $sectors = Category::where('model', 'References')->withCount('references')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.references.sectors.translate', [
            'sector' => $sector,
            'sectors' => $sectors,
        ]);
    }

    public function sectorsUpdateTranslate(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:160'],
        ], [
            'title.required' => 'Sektör adı alanı gereklidir.',
            'description.required' => 'Açıklama alanı gereklidir.',
            'description.max' => 'Açıklama en fazla 160 karakter olmalıdır.',
        ]);
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();
        $sector = Category::findOrFail($id);

        $sector->setTranslation('name', $translateLang, $request->title);
        $sector->setTranslation('description', $translateLang, $request->description);
        $sector->save();

        return redirect()->route('references.sectors.index')->with('success', 'Sektör başarıyla güncellendi.');
    }
    public function sectorsEdit(Request $request, $id)
    {
        $sector = Category::where('id', $id)->where('model', 'References')->first();
        if (!$sector) {
            return redirect()->route('references.sectors.index')->with('error', 'Sektör bulunamadı.');
        }
        $sectors = Category::where('model', 'References')->withCount('references')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.references.sectors.edit', [
            'sector' => $sector,
            'sectors' => $sectors,
        ]);
    }

    public function sectorsUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:160'],
        ], [
            'title.required' => 'Sektör adı alanı gereklidir.',
            'description.required' => 'Açıklama alanı gereklidir.',
            'description.max' => 'Açıklama en fazla 160 karakter olmalıdır.',
        ]);
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();
        $sector = Category::findOrFail($id);

        $sector->setTranslation('name', $translateLang, $request->title);
        $sector->setTranslation('description', $translateLang, $request->description);
        $sector->slug = $this->generateSlug($request->title, $id);
        $sector->save();

        return redirect()->route('references.sectors.index')->with('success', 'Sektör başarıyla güncellendi.');
    }

    public function sectorsDelete($id)
    {
        $sector = Category::findOrFail($id);
        $sector->delete();

        return redirect()->route('references.sectors.index')->with('success', 'Sektör başarıyla silindi.');
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

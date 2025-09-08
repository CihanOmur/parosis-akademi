<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Projects\ProjectGallery;
use App\Models\Projects\ProjectInfoItems;
use App\Models\Projects\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $projects = Projects::with('category')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("title->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->paginate(10);

        return view('admin.projects.index', [
            'projects' => $projects,
        ]);
    }
    public function create(Request $request)
    {
        $categories = Category::where('model', 'Projects')->where('is_active', true)->get();
        return view('admin.projects.create', [
            'categories' => $categories
        ]);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'short_content' => 'required|string|max:500',
                'content' => 'required|string|max:3000',
                'category' => 'required|exists:categories,id',
                'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'info_items' => 'array',
                'info_items.*.title' => 'required|string|max:255',
                'info_items.*.description' => 'nullable|string|max:1000',
                'gallery_items' => 'array',
                'gallery_items.*.title' => 'required|string|max:255',
                'gallery_items.*.uploaded_file' => 'required|string|max:255',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'short_content.required' => 'Kısa açıklama alanı gereklidir.',
                'short_content.string' => 'Kısa açıklama alanı metin olmalıdır.',
                'short_content.max' => 'Kısa açıklama alanı en fazla 500 karakter olmalıdır.',
                'content.required' => 'Açıklama alanı gereklidir.',
                'content.string' => 'Açıklama alanı metin olmalıdır.',
                'content.max' => 'Açıklama alanı en fazla 3000 karakter olmalıdır.',
                'category.required' => 'Kategori alanı gereklidir.',
                'category.exists' => 'Seçilen kategori geçerli değil.',
                'file.required' => 'Dosya alanı gereklidir.',
                'file.file' => 'Dosya alanı geçerli bir dosya olmalıdır.',
                'file.mimes' => 'Dosya alanı yalnızca jpg, jpeg ve png uzantılı dosyaları kabul etmektedir.',
                'file.max' => 'Dosya alanı en fazla 2MB boyutunda olmalıdır.',
                'info_items.*.title.required' => 'Bilgi başlığı alanı gereklidir.',
                'info_items.*.title.string' => 'Bilgi başlığı alanı metin olmalıdır.',
                'info_items.*.title.max' => 'Bilgi başlığı alanı en fazla 255 karakter olmalıdır.',
                'info_items.*.description.string' => 'Bilgi açıklaması alanı metin olmalıdır.',
                'info_items.*.description.max' => 'Bilgi açıklaması alanı en fazla 1000 karakter olmalıdır.',
                'gallery_items.*.title.required' => 'Galeri başlığı alanı gereklidir.',
                'gallery_items.*.title.string' => 'Galeri başlığı alanı metin olmalıdır.',
                'gallery_items.*.title.max' => 'Galeri başlığı alanı en fazla 255 karakter olmalıdır.',
                'gallery_items.*.uploaded_file.required' => 'Galeri dosyası alanı gereklidir.',
                'gallery_items.*.uploaded_file.string' => 'Galeri dosyası alanı metin olmalıdır.',
                'gallery_items.*.uploaded_file.max' => 'Galeri dosyası alanı en fazla 255 karakter olmalıdır.',
            ]
        );

        $project = new Projects();
        $project->title = $request->title;
        $project->short_content = $request->short_content;
        $project->content = $request->input('content');
        $project->category_id = $request->category;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('projects', $filename, 'public');
            $project->image_url = $filename;
        }
        $project->save();

        if ($request->has('info_items')) {
            foreach ($request->info_items as $info) {
                $infoItem = new ProjectInfoItems();
                $infoItem->title = $info['title'];
                $infoItem->content = $info['description'] ?? null;
                $infoItem->project_id = $project->id;
                $infoItem->save();
            }
        }
        if ($request->has('gallery_items')) {
            foreach ($request->gallery_items as $gallery) {
                $mimeType = $gallery['file']->getMimeType();

                if (str_starts_with($mimeType, 'image/')) {
                    $type = true; // resim dosyası
                } elseif (str_starts_with($mimeType, 'video/')) {
                    $type = false; // video dosyası
                } else {
                    $type = true;
                }

                $galleryItem = new ProjectGallery();
                $galleryItem->title = $gallery['title'];
                $galleryItem->file_url = $gallery['uploaded_file'];
                $galleryItem->project_id = $project->id;
                $galleryItem->is_image = $type;
                $galleryItem->save();
            }
        }

        return redirect()->route('projects.index')->with('success', 'Proje başarıyla eklendi.');
    }

    public function editTranslate($id)
    {
        $project = Projects::findOrFail($id);

        return view('admin.projects.translate', [
            'project' => $project,

        ]);
    }

    public function updateTranslate(Request $request, $id)
    {

        $project = Projects::findOrFail($id);

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'short_content' => 'required|string|max:500',
                'content' => 'required|string|max:3000',

            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'short_content.required' => 'Kısa açıklama alanı gereklidir.',
                'short_content.string' => 'Kısa açıklama alanı metin olmalıdır.',
                'short_content.max' => 'Kısa açıklama alanı en fazla 500 karakter olmalıdır.',
                'content.required' => 'Açıklama alanı gereklidir.',
                'content.string' => 'Açıklama alanı metin olmalıdır.',
                'content.max' => 'Açıklama alanı en fazla 3000 karakter olmalıdır.',

            ]
        );
        $languageData = getLocaleInfo($request->lang);

        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $project->setTranslation('title', $translateLang, $request->title);
        $project->setTranslation('short_content', $translateLang, $request->short_content);
        $project->setTranslation('content', $translateLang, $request->input('content'));
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Proje başarıyla güncellendi.');
    }
    public function edit($id)
    {
        $project = Projects::with(['category', 'infoItems', 'gallery'])->findOrFail($id);
        $categories = Category::where('model', 'Projects')->where('is_active', true)->get();
        return view('admin.projects.edit', [
            'project' => $project,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {

        $project = Projects::findOrFail($id);

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'short_content' => 'required|string|max:500',
                'content' => 'required|string|max:3000',
                'category' => 'required|exists:categories,id',
                'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'info_items' => 'array',
                'info_items.*.title' => 'required|string|max:255',
                'info_items.*.description' => 'nullable|string|max:1000',
                'gallery_items' => 'array',
                'gallery_items.*.title' => 'required|string|max:255',
                'gallery_items.*.uploaded_file' => 'required|string|max:255',
            ],
            [
                'title.required' => 'Başlık alanı gereklidir.',
                'title.string' => 'Başlık alanı metin olmalıdır.',
                'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
                'short_content.required' => 'Kısa açıklama alanı gereklidir.',
                'short_content.string' => 'Kısa açıklama alanı metin olmalıdır.',
                'short_content.max' => 'Kısa açıklama alanı en fazla 500 karakter olmalıdır.',
                'content.required' => 'Açıklama alanı gereklidir.',
                'content.string' => 'Açıklama alanı metin olmalıdır.',
                'content.max' => 'Açıklama alanı en fazla 3000 karakter olmalıdır.',
                'category.required' => 'Kategori alanı gereklidir.',
                'category.exists' => 'Seçilen kategori geçerli değil.',
                'file.file' => 'Dosya alanı geçerli bir dosya olmalıdır.',
                'file.mimes' => 'Dosya alanı yalnızca jpg, jpeg ve png uzantılı dosyaları kabul etmektedir.',
                'file.max' => 'Dosya alanı en fazla 2MB boyutunda olmalıdır.',
                'info_items.*.title.required' => 'Bilgi başlığı alanı gereklidir.',
                'info_items.*.title.string' => 'Bilgi başlığı alanı metin olmalıdır.',
                'info_items.*.title.max' => 'Bilgi başlığı alanı en fazla 255 karakter olmalıdır.',
                'info_items.*.description.string' => 'Bilgi açıklaması alanı metin olmalıdır.',
                'info_items.*.description.max' => 'Bilgi açıklaması alanı en fazla 1000 karakter olmalıdır.',
                'gallery_items.*.title.required' => 'Galeri başlığı alanı gereklidir.',
                'gallery_items.*.title.string' => 'Galeri başlığı alanı metin olmalıdır.',
                'gallery_items.*.title.max' => 'Galeri başlığı alanı en fazla 255 karakter olmalıdır.',
                'gallery_items.*.uploaded_file.required' => 'Galeri dosyası alanı gereklidir.',
                'gallery_items.*.uploaded_file.string' => 'Galeri dosyası alanı metin olmalıdır.',
                'gallery_items.*.uploaded_file.max' => 'Galeri dosyası alanı en fazla 255 karakter olmalıdır.',
            ]
        );
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $project->setTranslation('title', $translateLang, $request->title);
        $project->setTranslation('short_content', $translateLang, $request->short_content);
        $project->setTranslation('content', $translateLang, $request->input('content'));
        $project->category_id = $request->category;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('projects', $filename, 'public');
            $project->image_url = $filename;
        }
        $project->save();

        if ($request->has('info_items')) {
            $project->infoItems()->delete();
            foreach ($request->info_items as $info) {
                ProjectInfoItems::create([
                    'title' => $info['title'],
                    'content' => $info['description'] ?? null,
                    'project_id' => $project->id,
                ]);
            }
        }

        if ($request->has('gallery_items')) {
            $projectOldGalleryItemsTitles = $project->gallery->pluck('file_url')->toArray();
            $projectNewGalleryItemsTitles = collect($request->gallery_items)->pluck('uploaded_file')->toArray();
            $galleryItemsToDelete = array_diff($projectOldGalleryItemsTitles, $projectNewGalleryItemsTitles);

            ProjectGallery::where('project_id', $project->id)
                ->whereIn('file_url', $galleryItemsToDelete)
                ->delete();
            foreach ($request->gallery_items as $gallery) {
                if (isset($gallery['file']) && $gallery['file'] != '') {
                    $mimeType = $gallery['file']->getMimeType();

                    if (str_starts_with($mimeType, 'image/')) {
                        $type = true; // resim dosyası
                    } elseif (str_starts_with($mimeType, 'video/')) {
                        $type = false; // video dosyası
                    } else {
                        $type = true;
                    }

                    $galleryItem = new ProjectGallery();
                    $galleryItem->title = $gallery['title'];
                    $galleryItem->file_url = $gallery['uploaded_file'];
                    $galleryItem->project_id = $project->id;
                    $galleryItem->is_image = $type;
                    $galleryItem->save();
                }
            }
        }

        return redirect()->route('projects.index')->with('success', 'Proje başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $project = Projects::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proje başarıyla silindi.');
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
    public function categoryIndex(Request $request)
    {
        $categories = Category::where('model', 'Projects')->withCount('projects')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.projects.categories.index', [
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
        $category->model = 'Projects';
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('projects.categories.index')->with('success', 'Category created successfully.');
    }

    public function categoryEditTranslate(Request $request, $id)
    {
        $category = Category::where('id', $id)->where('model', 'Projects')->first();
        if (!$category) {
            return redirect()->route('projects.categories.index')->with('error', 'Category not found.');
        }
        $categories = Category::where('model', 'Projects')->withCount('projects')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.projects.categories.translate', [
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

        $category = Category::where('id', $id)->where('model', 'Projects')->first();
        if (!$category) {
            return redirect()->route('projects.categories.index')->with('error', 'Category not found.');
        }
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $category->setTranslation('name', $translateLang, $request->title);
        $category->setTranslation('description', $translateLang, $request->description);
        $category->slug = $this->generateSlug($request->title, $id);
        $category->save();

        return redirect()->route('projects.categories.index')->with('success', 'Category updated successfully.');
    }
    public function categoryEdit(Request $request, $id)
    {
        $category = Category::where('id', $id)->where('model', 'Projects')->first();
        if (!$category) {
            return redirect()->route('projects.categories.index')->with('error', 'Category not found.');
        }
        $categories = Category::where('model', 'Projects')->withCount('projects')->when($request->search, function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'LIKE', '%' . $request->search . '%');
        })->get();
        return view('admin.projects.categories.edit', [
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

        $category = Category::where('id', $id)->where('model', 'Projects')->first();
        if (!$category) {
            return redirect()->route('projects.categories.index')->with('error', 'Category not found.');
        }
        $languageData = getLocaleInfo($request->lang);
        $translateLang = $languageData['translateLang'] ?? app()->getLocale();

        $category->setTranslation('name', $translateLang, $request->title);
        $category->setTranslation('description', $translateLang, $request->description);
        $category->slug = $this->generateSlug($request->title, $id);
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('projects.categories.index')->with('success', 'Category updated successfully.');
    }

    public function categoryDelete($id)
    {
        $category = Category::where('id', $id)->where('model', 'Projects')->first();
        if (!$category) {
            return redirect()->route('projects.categories.index')->with('error', 'Category not found.');
        }

        $category->delete();

        return redirect()->route('projects.categories.index')->with('success', 'Category deleted successfully.');
    }

    public function uploadGallery(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,webp,mp4,webm,mov|max:51200', // 50 MB max
        ]);

        $file = $request->file('file');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('projects', $filename, 'public');

        return response()->json(['file_name' => $filename]);
    }
}

<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blogs\Blog;
use App\Models\Blogs\BlogCategory;
use App\Models\Blogs\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['categories', 'blogTags'])->orderBy('sort_order')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->orderBy('sort_order')->get();
        $tags = BlogTag::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.blog.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:blog_categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:blog_tags,id',
        ]);

        $locale = app()->getLocale();

        $blog = new Blog();
        $blog->setTranslation('title', $locale, $request->title);

        if ($request->filled('short_description')) {
            $blog->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->filled('content')) {
            $blog->setTranslation('content', $locale, $request->content);
        }

        $blog->published_at = $request->published_at;
        $blog->sort_order = Blog::max('sort_order') + 1;
        $blog->is_active = true;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogs'), $filename);
            $blog->image = 'uploads/blogs/' . $filename;
        }

        $blog->save();

        // Sync categories and tags
        if ($request->has('category_ids')) {
            $blog->categories()->sync($request->category_ids ?? []);
        }
        if ($request->has('tag_ids')) {
            $blog->blogTags()->sync($request->tag_ids ?? []);
        }

        return redirect()->route('blogs.index')
            ->with('success', 'Blog yazısı başarıyla eklendi.');
    }

    public function edit($id)
    {
        $blog = Blog::with(['categories', 'blogTags'])->findOrFail($id);
        $categories = BlogCategory::where('is_active', true)->orderBy('sort_order')->get();
        $tags = BlogTag::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.blog.edit', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:blog_categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:blog_tags,id',
        ]);

        $blog = Blog::findOrFail($id);
        $locale = app()->getLocale();

        $blog->setTranslation('title', $locale, $request->title);

        if ($request->has('short_description')) {
            $blog->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->has('content')) {
            $blog->setTranslation('content', $locale, $request->content);
        }

        $blog->published_at = $request->published_at;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogs'), $filename);
            $blog->image = 'uploads/blogs/' . $filename;
        }

        $blog->save();

        // Sync categories and tags
        $blog->categories()->sync($request->category_ids ?? []);
        $blog->blogTags()->sync($request->tag_ids ?? []);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog yazısı başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog yazısı silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:blogs,id',
        ]);

        foreach ($request->order as $index => $id) {
            Blog::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->is_active = !$blog->is_active;
        $blog->save();

        return response()->json([
            'status'  => 1,
            'message' => $blog->is_active ? 'Blog aktif edildi.' : 'Blog pasif edildi.',
            'action'  => $blog->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $blog = Blog::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.blog.edit-translate', compact('blog', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'lang'  => 'required|string',
        ]);

        $blog = Blog::findOrFail($id);
        $locale = $request->lang;

        $blog->setTranslation('title', $locale, $request->title);

        if ($request->filled('short_description')) {
            $blog->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->filled('content')) {
            $blog->setTranslation('content', $locale, $request->content);
        }

        $blog->save();

        return redirect()->route('blogs.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}

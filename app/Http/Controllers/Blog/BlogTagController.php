<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blogs\BlogTag;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    public function index()
    {
        $tags = BlogTag::orderBy('sort_order')->get();
        return view('admin.blog.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.blog.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $locale = app()->getLocale();

        $tag = new BlogTag();
        $tag->setTranslation('name', $locale, $request->name);
        $tag->sort_order = BlogTag::max('sort_order') + 1;
        $tag->is_active = true;
        $tag->save();

        return redirect()->route('blogTags.index')
            ->with('success', 'Blog etiketi başarıyla eklendi.');
    }

    public function edit($id)
    {
        $tag = BlogTag::findOrFail($id);
        return view('admin.blog.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $tag = BlogTag::findOrFail($id);
        $locale = app()->getLocale();

        $tag->setTranslation('name', $locale, $request->name);
        $tag->save();

        return redirect()->route('blogTags.index')
            ->with('success', 'Blog etiketi başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $tag = BlogTag::findOrFail($id);
        $tag->delete();

        return redirect()->route('blogTags.index')
            ->with('success', 'Blog etiketi silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:blog_tags,id',
        ]);

        foreach ($request->order as $index => $id) {
            BlogTag::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $tag = BlogTag::findOrFail($id);
        $tag->is_active = !$tag->is_active;
        $tag->save();

        return response()->json([
            'status'  => 1,
            'message' => $tag->is_active ? 'Etiket aktif edildi.' : 'Etiket pasif edildi.',
            'action'  => $tag->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $tag = BlogTag::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.blog.tags.edit-translate', compact('tag', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'lang' => 'required|string',
        ]);

        $tag = BlogTag::findOrFail($id);
        $locale = $request->lang;

        $tag->setTranslation('name', $locale, $request->name);
        $tag->save();

        return redirect()->route('blogTags.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}

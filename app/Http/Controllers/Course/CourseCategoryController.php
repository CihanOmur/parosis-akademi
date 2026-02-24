<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Courses\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::orderBy('sort_order')->get();
        return view('admin.course.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.course.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $locale = app()->getLocale();

        $category = new CourseCategory();
        $category->setTranslation('name', $locale, $request->name);
        $category->sort_order = CourseCategory::max('sort_order') + 1;
        $category->is_active = true;
        $category->save();

        return redirect()->route('courseCategories.index')
            ->with('success', 'Kurs kategorisi başarıyla eklendi.');
    }

    public function edit($id)
    {
        $category = CourseCategory::findOrFail($id);
        return view('admin.course.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $category = CourseCategory::findOrFail($id);
        $locale = app()->getLocale();

        $category->setTranslation('name', $locale, $request->name);
        $category->save();

        return redirect()->route('courseCategories.index')
            ->with('success', 'Kurs kategorisi başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $category = CourseCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('courseCategories.index')
            ->with('success', 'Kurs kategorisi silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:course_categories,id',
        ]);

        foreach ($request->order as $index => $id) {
            CourseCategory::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $category = CourseCategory::findOrFail($id);
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
        $category = CourseCategory::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.course.categories.edit-translate', compact('category', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'lang' => 'required|string',
        ]);

        $category = CourseCategory::findOrFail($id);
        $locale = $request->lang;

        $category->setTranslation('name', $locale, $request->name);
        $category->save();

        return redirect()->route('courseCategories.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}

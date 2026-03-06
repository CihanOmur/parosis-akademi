<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Courses\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ValidationMessageService;

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
            'name'  => 'required|string|max:200',
            'icon'  => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'color' => 'nullable|string|max:20',
        ], ValidationMessageService::getMessages('course_cat_store'));

        $locale = app()->getLocale();

        $category = new CourseCategory();
        $category->setTranslation('name', $locale, $request->name);
        $category->color = $request->color;
        $category->sort_order = CourseCategory::max('sort_order') + 1;
        $category->is_active = true;

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/course-categories'), $filename);
            $category->icon = 'uploads/course-categories/' . $filename;
        }

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
            'name'  => 'required|string|max:200',
            'icon'  => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:1024',
            'color' => 'nullable|string|max:20',
        ], ValidationMessageService::getMessages('course_cat_update'));

        $category = CourseCategory::findOrFail($id);
        $locale = app()->getLocale();

        $category->setTranslation('name', $locale, $request->name);
        $category->color = $request->color;

        if ($request->hasFile('icon')) {
            if ($category->icon && file_exists(public_path($category->icon))) {
                unlink(public_path($category->icon));
            }
            $file = $request->file('icon');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/course-categories'), $filename);
            $category->icon = 'uploads/course-categories/' . $filename;
        }

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
        ], ValidationMessageService::getMessages('course_cat_order'));

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
        ], ValidationMessageService::getMessages('course_cat_translate'));

        $category = CourseCategory::findOrFail($id);
        $locale = $request->lang;

        $category->setTranslation('name', $locale, $request->name);
        $category->save();

        return redirect()->route('courseCategories.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}

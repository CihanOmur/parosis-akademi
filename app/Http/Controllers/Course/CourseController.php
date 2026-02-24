<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseCategory;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('categories')->orderBy('sort_order')->get();
        return view('admin.course.index', compact('courses'));
    }

    public function create()
    {
        $categories = CourseCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.course.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'inner_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'instructor_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:course_categories,id',
        ]);

        $locale = app()->getLocale();

        $course = new Course();
        $course->setTranslation('title', $locale, $request->title);

        if ($request->filled('short_description')) {
            $course->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->filled('content')) {
            $course->setTranslation('content', $locale, $request->content);
        }
        if ($request->filled('what_you_learn')) {
            $course->setTranslation('what_you_learn', $locale, $request->what_you_learn);
        }
        if ($request->filled('why_choose')) {
            $course->setTranslation('why_choose', $locale, $request->why_choose);
        }

        $course->price = $request->price;
        $course->duration = $request->duration;
        $course->lesson_count = $request->lesson_count;
        $course->language = $request->language;
        $course->student_count = $request->student_count;
        $course->has_certification = $request->boolean('has_certification');
        $course->instructor_name = $request->instructor_name;
        $course->published_at = $request->published_at;
        $course->sort_order = Course::max('sort_order') + 1;
        $course->is_active = true;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);
            $course->image = 'uploads/courses/' . $filename;
        }

        if ($request->hasFile('inner_image')) {
            $file = $request->file('inner_image');
            $filename = time() . '_inner_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);
            $course->inner_image = 'uploads/courses/' . $filename;
        }

        if ($request->hasFile('instructor_image')) {
            $file = $request->file('instructor_image');
            $filename = time() . '_inst_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);
            $course->instructor_image = 'uploads/courses/' . $filename;
        }

        $course->save();

        if ($request->has('category_ids')) {
            $course->categories()->sync($request->category_ids ?? []);
        }

        return redirect()->route('courses.index')
            ->with('success', 'Kurs başarıyla eklendi.');
    }

    public function edit($id)
    {
        $course = Course::with('categories')->findOrFail($id);
        $categories = CourseCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.course.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'inner_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'instructor_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:course_categories,id',
        ]);

        $course = Course::findOrFail($id);
        $locale = app()->getLocale();

        $course->setTranslation('title', $locale, $request->title);

        if ($request->has('short_description')) {
            $course->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->has('content')) {
            $course->setTranslation('content', $locale, $request->content);
        }
        if ($request->has('what_you_learn')) {
            $course->setTranslation('what_you_learn', $locale, $request->what_you_learn);
        }
        if ($request->has('why_choose')) {
            $course->setTranslation('why_choose', $locale, $request->why_choose);
        }

        $course->price = $request->price;
        $course->duration = $request->duration;
        $course->lesson_count = $request->lesson_count;
        $course->language = $request->language;
        $course->student_count = $request->student_count;
        $course->has_certification = $request->boolean('has_certification');
        $course->instructor_name = $request->instructor_name;
        $course->published_at = $request->published_at;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);
            $course->image = 'uploads/courses/' . $filename;
        }

        if ($request->hasFile('inner_image')) {
            $file = $request->file('inner_image');
            $filename = time() . '_inner_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);
            $course->inner_image = 'uploads/courses/' . $filename;
        }

        if ($request->hasFile('instructor_image')) {
            $file = $request->file('instructor_image');
            $filename = time() . '_inst_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);
            $course->instructor_image = 'uploads/courses/' . $filename;
        }

        $course->save();

        $course->categories()->sync($request->category_ids ?? []);

        return redirect()->route('courses.index')
            ->with('success', 'Kurs başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Kurs silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:courses,id',
        ]);

        foreach ($request->order as $index => $id) {
            Course::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $course = Course::findOrFail($id);
        $course->is_active = !$course->is_active;
        $course->save();

        return response()->json([
            'status'  => 1,
            'message' => $course->is_active ? 'Kurs aktif edildi.' : 'Kurs pasif edildi.',
            'action'  => $course->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $course = Course::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.course.edit-translate', compact('course', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'lang'  => 'required|string',
        ]);

        $course = Course::findOrFail($id);
        $locale = $request->lang;

        $course->setTranslation('title', $locale, $request->title);

        if ($request->filled('short_description')) {
            $course->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->filled('content')) {
            $course->setTranslation('content', $locale, $request->content);
        }
        if ($request->filled('what_you_learn')) {
            $course->setTranslation('what_you_learn', $locale, $request->what_you_learn);
        }
        if ($request->filled('why_choose')) {
            $course->setTranslation('why_choose', $locale, $request->why_choose);
        }

        $course->save();

        return redirect()->route('courses.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}

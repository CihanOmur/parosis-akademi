<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('sort_order')->get();
        return view('admin.teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teacher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:200',
            'title' => 'required|string|max:200',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $locale = app()->getLocale();

        $teacher = new Teacher();
        $teacher->setTranslation('name', $locale, $request->name);
        $teacher->setTranslation('title', $locale, $request->title);

        if ($request->filled('short_description')) {
            $teacher->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->filled('bio')) {
            $teacher->setTranslation('bio', $locale, $request->bio);
        }

        // Non-translatable fields
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->facebook_url = $request->facebook_url;
        $teacher->twitter_url = $request->twitter_url;
        $teacher->dribbble_url = $request->dribbble_url;
        $teacher->instagram_url = $request->instagram_url;
        $teacher->sort_order = Teacher::max('sort_order') + 1;
        $teacher->is_active = true;

        // Image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/teachers'), $filename);
            $teacher->image = 'uploads/teachers/' . $filename;
        }

        $teacher->save();

        return redirect()->route('teachers.index')
            ->with('success', 'Eğitmen başarıyla eklendi.');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:200',
            'title' => 'required|string|max:200',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $teacher = Teacher::findOrFail($id);
        $locale = app()->getLocale();

        $teacher->setTranslation('name', $locale, $request->name);
        $teacher->setTranslation('title', $locale, $request->title);

        if ($request->has('short_description')) {
            $teacher->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->has('bio')) {
            $teacher->setTranslation('bio', $locale, $request->bio);
        }

        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->facebook_url = $request->facebook_url;
        $teacher->twitter_url = $request->twitter_url;
        $teacher->dribbble_url = $request->dribbble_url;
        $teacher->instagram_url = $request->instagram_url;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/teachers'), $filename);
            $teacher->image = 'uploads/teachers/' . $filename;
        }

        $teacher->save();

        return redirect()->route('teachers.index')
            ->with('success', 'Eğitmen başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Eğitmen silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:teachers,id',
        ]);

        foreach ($request->order as $index => $id) {
            Teacher::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->is_active = !$teacher->is_active;
        $teacher->save();

        return response()->json([
            'status'  => 1,
            'message' => $teacher->is_active ? 'Eğitmen aktif edildi.' : 'Eğitmen pasif edildi.',
            'action'  => $teacher->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $teacher = Teacher::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.teacher.edit-translate', compact('teacher', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:200',
            'title' => 'required|string|max:200',
            'lang'  => 'required|string',
        ]);

        $teacher = Teacher::findOrFail($id);
        $locale = $request->lang;

        $teacher->setTranslation('name', $locale, $request->name);
        $teacher->setTranslation('title', $locale, $request->title);

        if ($request->filled('short_description')) {
            $teacher->setTranslation('short_description', $locale, $request->short_description);
        }
        if ($request->filled('bio')) {
            $teacher->setTranslation('bio', $locale, $request->bio);
        }

        $teacher->save();

        return redirect()->route('teachers.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}

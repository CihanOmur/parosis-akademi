<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use App\Models\Testimonial\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'role'   => 'nullable|string|max:255',
            'quote'  => 'required|string|max:2000',
            'image'  => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $locale = app()->getLocale();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $imagePath = 'uploads/testimonials/' . $filename;
        }

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->setTranslation('role', $locale, $request->role ?? '');
        $testimonial->setTranslation('quote', $locale, $request->quote);
        $testimonial->image = $imagePath;
        $testimonial->rating = $request->rating;
        $testimonial->sort_order = Testimonial::max('sort_order') + 1;
        $testimonial->is_active = true;
        $testimonial->save();

        return redirect()->route('testimonials.index')
            ->with('success', 'Yorum başarıyla eklendi.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'role'   => 'nullable|string|max:255',
            'quote'  => 'required|string|max:2000',
            'image'  => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $locale = app()->getLocale();

        $testimonial->name = $request->name;
        $testimonial->setTranslation('role', $locale, $request->role ?? '');
        $testimonial->setTranslation('quote', $locale, $request->quote);
        $testimonial->rating = $request->rating;

        if ($request->hasFile('image')) {
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                unlink(public_path($testimonial->image));
            }
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $testimonial->image = 'uploads/testimonials/' . $filename;
        }

        $testimonial->save();

        return redirect()->route('testimonials.index')
            ->with('success', 'Yorum başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->image && file_exists(public_path($testimonial->image))) {
            unlink(public_path($testimonial->image));
        }

        $testimonial->delete();

        return redirect()->route('testimonials.index')
            ->with('success', 'Yorum silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:testimonials,id',
        ]);

        foreach ($request->order as $index => $id) {
            Testimonial::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_active = !$testimonial->is_active;
        $testimonial->save();

        return response()->json([
            'status'  => 1,
            'message' => $testimonial->is_active ? 'Yorum aktif edildi.' : 'Yorum pasif edildi.',
            'action'  => $testimonial->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $testimonial = Testimonial::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.testimonial.edit-translate', compact('testimonial', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'role'  => 'nullable|string|max:255',
            'quote' => 'required|string|max:2000',
            'lang'  => 'required|string',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $locale = $request->lang;

        $testimonial->setTranslation('role', $locale, $request->role ?? '');
        $testimonial->setTranslation('quote', $locale, $request->quote);
        $testimonial->save();

        return redirect()->route('testimonials.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}

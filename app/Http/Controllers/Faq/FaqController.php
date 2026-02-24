<?php

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string|max:5000',
        ]);

        $locale = app()->getLocale();

        $faq = new Faq();
        $faq->setTranslation('question', $locale, $request->question);
        $faq->setTranslation('answer', $locale, $request->answer);
        $faq->sort_order = Faq::max('sort_order') + 1;
        $faq->is_active = true;
        $faq->save();

        return redirect()->route('faq.index')
            ->with('success', 'SSS maddesi başarıyla eklendi.');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string|max:5000',
        ]);

        $faq = Faq::findOrFail($id);
        $locale = app()->getLocale();

        $faq->setTranslation('question', $locale, $request->question);
        $faq->setTranslation('answer', $locale, $request->answer);
        $faq->save();

        return redirect()->route('faq.index')
            ->with('success', 'SSS maddesi başarıyla güncellendi.');
    }

    public function delete($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faq.index')
            ->with('success', 'SSS maddesi silindi.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:faqs,id',
        ]);

        foreach ($request->order as $index => $id) {
            Faq::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 1, 'message' => 'Sıralama güncellendi.']);
    }

    public function toggleActive($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->is_active = !$faq->is_active;
        $faq->save();

        return response()->json([
            'status'  => 1,
            'message' => $faq->is_active ? 'SSS maddesi aktif edildi.' : 'SSS maddesi pasif edildi.',
            'action'  => $faq->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function editTranslate($id, $lang)
    {
        $faq = Faq::findOrFail($id);
        $localeInfo = getLocaleInfo($lang);
        $selectedLang = $localeInfo['translateLang'];
        $selectedLanguage = $localeInfo['selectedLanguage'];

        return view('admin.faq.edit-translate', compact('faq', 'selectedLang', 'selectedLanguage'));
    }

    public function updateTranslate(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string|max:5000',
            'lang'     => 'required|string',
        ]);

        $faq = Faq::findOrFail($id);
        $locale = $request->lang;

        $faq->setTranslation('question', $locale, $request->question);
        $faq->setTranslation('answer', $locale, $request->answer);
        $faq->save();

        return redirect()->route('faq.edit', $id)
            ->with('success', 'Çeviri başarıyla güncellendi.');
    }
}

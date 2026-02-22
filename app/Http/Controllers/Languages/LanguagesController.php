<?php

namespace App\Http\Controllers\Languages;

use App\Http\Controllers\Controller;
use App\Models\Languages\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LanguagesController extends Controller
{
    public function index()
    {
        $languages = Languages::where('status', 1)->orderByDesc('is_default')->orderBy('locale')->paginate(20);
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * AJAX: Aktif/Pasif toggle (is_active alanı)
     */
    public function toggleActive(Request $request)
    {
        $request->validate(['id' => 'required|exists:languages,id']);

        $language = Languages::findOrFail($request->id);
        $language->is_active = !$language->is_active;
        $language->save();

        return response()->json([
            'status'  => 1,
            'message' => $language->is_active ? 'Dil aktif edildi.' : 'Dil pasif edildi.',
            'action'  => $language->is_active ? 'Aktif' : 'Pasif',
        ]);
    }

    public function create(Request $request)
    {
        $localeInfo   = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        return view('admin.languages.create', compact('selectedLang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'locale'       => ['required', 'string', 'regex:/^[a-z]{2}(-[a-z]{2,4})?$/', 'unique:languages,locale'],
            'default_name' => 'required|string|max:100',
        ], [
            'locale.required' => 'Locale kodu zorunludur.',
            'locale.regex'    => 'Geçerli bir locale kodu girin (ör: tr, en, en-gb, zh-cn).',
            'locale.unique'   => 'Bu locale kodu zaten kullanılıyor.',
            'default_name.required' => 'Dil adı zorunludur.',
        ]);

        $language = new Languages();
        $language->locale    = $request->locale;
        $language->status    = 1;
        $language->is_active = $request->has('is_active') ? 1 : 0;

        // Kendi locale'inde varsayılan isim
        $language->setTranslation('name', $request->locale, $request->default_name);

        // Diğer aktif dillerdeki çeviriler
        foreach ($request->names ?? [] as $locale => $value) {
            if ($value) {
                $language->setTranslation('name', $locale, $value);
            }
        }

        $language->save();

        // Lang JSON dosyası oluştur
        $filePath = base_path('lang/' . $request->locale . '.json');
        if (!File::exists($filePath)) {
            File::put($filePath, json_encode(['welcome' => 'Welcome', 'hello' => 'Hello'],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        return redirect()->route('languages.index')
            ->with('success', '"' . $request->default_name . '" dili eklendi.');
    }

    public function edit(Request $request, $id)
    {
        $language     = Languages::findOrFail($id);
        $localeInfo   = getLocaleInfo($request->get('lang'));
        $selectedLang = $localeInfo['translateLang'];
        return view('admin.languages.edit', compact('language', 'selectedLang'));
    }

    public function update(Request $request, $id)
    {
        $language = Languages::findOrFail($id);

        $request->validate([
            'locale'       => ['required', 'string', 'regex:/^[a-z]{2}(-[a-z]{2,4})?$/', 'unique:languages,locale,' . $id],
            'default_name' => 'required|string|max:100',
        ], [
            'locale.required' => 'Locale kodu zorunludur.',
            'locale.regex'    => 'Geçerli bir locale kodu girin (ör: tr, en, en-gb, zh-cn).',
            'locale.unique'   => 'Bu locale kodu zaten kullanılıyor.',
            'default_name.required' => 'Dil adı zorunludur.',
        ]);

        $language->locale    = $request->locale;
        $language->is_active = $request->has('is_active') ? 1 : 0;

        // Kendi locale'inde isim
        $language->setTranslation('name', $request->locale, $request->default_name);

        // Diğer dillerdeki çeviriler
        foreach ($request->names ?? [] as $locale => $value) {
            if ($value) {
                $language->setTranslation('name', $locale, $value);
            }
        }

        $language->save();

        return redirect()->route('languages.index')
            ->with('success', 'Dil bilgileri güncellendi.');
    }

    public function setDefault(Request $request)
    {
        $request->validate(['id' => 'required|exists:languages,id']);

        $language = Languages::findOrFail($request->id);

        // Önce tüm dillerin is_default'unu sıfırla
        Languages::where('is_default', 1)->update(['is_default' => 0]);

        // Seçilen dili varsayılan yap ve aktif et
        $language->is_default = 1;
        $language->is_active  = 1;
        $language->save();

        return response()->json([
            'status'  => 1,
            'message' => ($language->name ?: $language->locale) . ' varsayılan dil olarak ayarlandı.',
            'id'      => $language->id,
        ]);
    }

    public function delete($id)
    {
        $language = Languages::findOrFail($id);
        $translations = $language->getTranslations('name');
        $displayName  = !empty($translations) ? array_values($translations)[0] : $language->locale;

        // Lang JSON dosyasını sil
        $filePath = base_path('lang/' . $language->locale . '.json');
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $language->delete();

        return redirect()->route('languages.index')
            ->with('success', '"' . $displayName . '" dili silindi.');
    }
}

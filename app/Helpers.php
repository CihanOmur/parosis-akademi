<?php

use App\Models\Languages\Languages;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('translateInput')) {
    /**
     * Modelin translatable alanını belirli bir dilde döndürür.
     *
     * @param  Model  $model
     * @param  string  $field
     * @param  string|null  $locale
     * @return string|null
     */
    function translateAttribute(Model $model, string $field, ?string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        if (!property_exists($model, 'translatable') || !in_array($field, $model->translatable)) {
            return $model->{$field} ?? null;
        }

        // Spatie getTranslation kullan
        return $model->getTranslation($field, $locale);
    }
}
if (!function_exists('getLocaleInfo')) {

    function getLocaleInfo($lang = null)
    {
        $translateLang = app()->getLocale();

        if ($lang != null) {
            $checkLang = Languages::where('locale', $lang)->where('status', 1)->where('is_active', 1)->first();
            if (!$checkLang) {
                $translateLang = app()->getLocale();
                $selectedLanguage = null;
            } else {
                $translateLang = $checkLang->locale;
                $selectedLanguage = $checkLang->name;
            }
        } else {
            $translateLang = app()->getLocale();
            $selectedLanguage = null;
        }

        return [
            'translateLang' => $translateLang,
            'selectedLanguage' => $selectedLanguage,
        ];
    }
}

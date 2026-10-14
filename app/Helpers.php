<?php

use App\Models\Languages\Languages;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('translateAttribute')) {
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
if (!function_exists('numberToWords')) {
    /**
     * Modelin translatable alanını belirli bir dilde döndürür.
     *
     * @param  Model  $model
     * @param  string  $field
     * @param  string|null  $locale
     * @return string|null
     */
    function numberToWords($number)
    {
        $ones = ['', 'bir', 'iki', 'üç', 'dört', 'beş', 'altı', 'yedi', 'sekiz', 'dokuz'];
        $tens = ['', 'on', 'yirmi', 'otuz', 'kırk', 'elli', 'altmış', 'yetmiş', 'seksen', 'doksan'];
        $thousands = ['', 'bin', 'milyon', 'milyar'];

        $number = (int)$number;
        if ($number == 0) return 'sıfır';

        $words = '';
        $i = 0;

        while ($number > 0) {
            $chunk = $number % 1000;
            $number = (int)($number / 1000);

            $hundreds = (int)($chunk / 100);
            $remainder = $chunk % 100;
            $chunkWords = '';

            if ($hundreds > 0) {
                if ($hundreds > 1) $chunkWords .= $ones[$hundreds] . ' ';
                $chunkWords .= 'yüz ';
            }

            $ten = (int)($remainder / 10);
            $one = $remainder % 10;

            if ($ten > 0) $chunkWords .= $tens[$ten] . ' ';
            if ($one > 0) $chunkWords .= $ones[$one] . ' ';

            // 🔹 Özel kontrol: 1000 → "bin" (başına 'bir' gelmesin)
            if ($i == 1 && trim($chunkWords) == 'bir') {
                $chunkWords = '';
            }

            if ($chunk > 0) {
                $words = trim($chunkWords) . ' ' . $thousands[$i] . ' ' . $words;
            }

            $i++;
        }

        return trim($words);
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
if (!function_exists('markdownLinksToHtml')) {
    /**
     * Metni HTML'e kaçırır ve [metin](url) sözdizimini <a>'ya çevirir.
     * Sadece http(s), / ile başlayan, mailto: ve tel: adresleri link olur; diğerleri düz metin kalır.
     * Dış (http) linkler yeni sekmede açılır.
     *
     * @param  string|null  $text
     * @param  string  $linkClass  <a> etiketine eklenecek CSS sınıfları
     * @return string
     */
    function markdownLinksToHtml(?string $text, string $linkClass = ''): string
    {
        $escaped = e((string) $text);

        // Eşleşmeler kaçırılmış metinden geldiği için tekrar kaçırılmaz
        return preg_replace_callback(
            '/\[([^\]]+)\]\(([^)\s]+)\)/u',
            function ($m) use ($linkClass) {
                $label = $m[1];
                $url = $m[2];
                if (!preg_match('#^(https?://|/|mailto:|tel:)#i', $url)) {
                    return $label;
                }
                $attrs = str_starts_with($url, 'http') ? ' target="_blank" rel="noopener"' : '';
                $class = $linkClass !== '' ? ' class="' . e($linkClass) . '"' : '';
                return '<a href="' . $url . '"' . $attrs . $class . '>' . $label . '</a>';
            },
            $escaped
        ) ?? $escaped;
    }
}

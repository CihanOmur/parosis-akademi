<?php

namespace Database\Seeders;

use App\Models\Languages\Languages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        // Locale: ISO 639-1 (tr, en) veya bölgesel variant (en-gb, pt-br, zh-cn)
        // native: kendi dilindeki adı, tr/en/ar: çeviriler
        $languages = [
            [
                'locale' => 'tr',
                'native' => 'Türkçe',
                'tr'     => 'Türkçe',
                'en'     => 'Turkish',
                'ar'     => 'التركية',
            ],
            [
                'locale' => 'en',
                'native' => 'English',
                'tr'     => 'İngilizce',
                'en'     => 'English',
                'ar'     => 'الإنجليزية',
            ],
            [
                'locale' => 'en-gb',
                'native' => 'English (UK)',
                'tr'     => 'İngilizce (İngiltere)',
                'en'     => 'English (UK)',
                'ar'     => 'الإنجليزية (بريطانيا)',
            ],
            [
                'locale' => 'ar',
                'native' => 'العربية',
                'tr'     => 'Arapça',
                'en'     => 'Arabic',
                'ar'     => 'العربية',
            ],
            [
                'locale' => 'de',
                'native' => 'Deutsch',
                'tr'     => 'Almanca',
                'en'     => 'German',
                'ar'     => 'الألمانية',
            ],
            [
                'locale' => 'fr',
                'native' => 'Français',
                'tr'     => 'Fransızca',
                'en'     => 'French',
                'ar'     => 'الفرنسية',
            ],
            [
                'locale' => 'es',
                'native' => 'Español',
                'tr'     => 'İspanyolca',
                'en'     => 'Spanish',
                'ar'     => 'الإسبانية',
            ],
            [
                'locale' => 'it',
                'native' => 'Italiano',
                'tr'     => 'İtalyanca',
                'en'     => 'Italian',
                'ar'     => 'الإيطالية',
            ],
            [
                'locale' => 'pt',
                'native' => 'Português',
                'tr'     => 'Portekizce',
                'en'     => 'Portuguese',
                'ar'     => 'البرتغالية',
            ],
            [
                'locale' => 'pt-br',
                'native' => 'Português (Brasil)',
                'tr'     => 'Portekizce (Brezilya)',
                'en'     => 'Portuguese (Brazil)',
                'ar'     => 'البرتغالية (البرازيل)',
            ],
            [
                'locale' => 'ru',
                'native' => 'Русский',
                'tr'     => 'Rusça',
                'en'     => 'Russian',
                'ar'     => 'الروسية',
            ],
            [
                'locale' => 'zh-cn',
                'native' => '中文 (简体)',
                'tr'     => 'Çince (Basitleştirilmiş)',
                'en'     => 'Chinese (Simplified)',
                'ar'     => 'الصينية (المبسطة)',
            ],
            [
                'locale' => 'zh-tw',
                'native' => '中文 (繁體)',
                'tr'     => 'Çince (Geleneksel)',
                'en'     => 'Chinese (Traditional)',
                'ar'     => 'الصينية (التقليدية)',
            ],
            [
                'locale' => 'ja',
                'native' => '日本語',
                'tr'     => 'Japonca',
                'en'     => 'Japanese',
                'ar'     => 'اليابانية',
            ],
            [
                'locale' => 'ko',
                'native' => '한국어',
                'tr'     => 'Korece',
                'en'     => 'Korean',
                'ar'     => 'الكورية',
            ],
            [
                'locale' => 'hi',
                'native' => 'हिन्दी',
                'tr'     => 'Hintçe',
                'en'     => 'Hindi',
                'ar'     => 'الهندية',
            ],
            [
                'locale' => 'nl',
                'native' => 'Nederlands',
                'tr'     => 'Hollandaca',
                'en'     => 'Dutch',
                'ar'     => 'الهولندية',
            ],
            [
                'locale' => 'pl',
                'native' => 'Polski',
                'tr'     => 'Lehçe',
                'en'     => 'Polish',
                'ar'     => 'البولندية',
            ],
            [
                'locale' => 'sv',
                'native' => 'Svenska',
                'tr'     => 'İsveççe',
                'en'     => 'Swedish',
                'ar'     => 'السويدية',
            ],
            [
                'locale' => 'fa',
                'native' => 'فارسی',
                'tr'     => 'Farsça',
                'en'     => 'Persian',
                'ar'     => 'الفارسية',
            ],
            [
                'locale' => 'ur',
                'native' => 'اردو',
                'tr'     => 'Urduca',
                'en'     => 'Urdu',
                'ar'     => 'الأردية',
            ],
        ];

        foreach ($languages as $lang) {
            $existing = Languages::where('locale', $lang['locale'])->first();

            if (!$existing) {
                $model = new Languages();
                $model->locale    = $lang['locale'];
                $model->status    = 1;
                $model->is_active = 0; // Varsayılan pasif — admin aktif eder

                $model->setTranslation('name', $lang['locale'], $lang['native']);
                $model->setTranslation('name', 'tr',            $lang['tr']);
                $model->setTranslation('name', 'en',            $lang['en']);
                $model->setTranslation('name', 'ar',            $lang['ar']);

                $model->save();
            } else {
                // Mevcut kayıtta eksik çeviriler varsa güncelle
                $translations = $existing->getTranslations('name');
                $updated = false;

                $toSet = [
                    'tr'           => $lang['tr'],
                    'en'           => $lang['en'],
                    'ar'           => $lang['ar'],
                    $lang['locale'] => $lang['native'],
                ];

                foreach ($toSet as $locale => $value) {
                    if (empty($translations[$locale])) {
                        $existing->setTranslation('name', $locale, $value);
                        $updated = true;
                    }
                }

                if ($updated) {
                    $existing->save();
                }
            }

            // Lang JSON dosyası oluştur (yoksa)
            $filePath = base_path('lang/' . $lang['locale'] . '.json');
            if (!File::exists($filePath)) {
                File::put($filePath, json_encode(
                    ['locale' => $lang['locale']],
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                ));
            }
        }
    }
}

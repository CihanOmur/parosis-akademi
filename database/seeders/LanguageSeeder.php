<?php

namespace Database\Seeders;

use App\Models\Languages\Languages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $languages = [
            ['name' => 'İngilizce (ABD)', 'locale' => 'en_US'],
            ['name' => 'İngilizce (İngiltere)', 'locale' => 'en_GB'],
            ['name' => 'Türkçe (Türkiye)', 'locale' => 'tr_TR'],
            ['name' => 'Almanca (Almanya)', 'locale' => 'de_DE'],
            ['name' => 'Fransızca (Fransa)', 'locale' => 'fr_FR'],
            ['name' => 'İspanyolca (İspanya)', 'locale' => 'es_ES'],
            ['name' => 'İspanyolca (Meksika)', 'locale' => 'es_MX'],
            ['name' => 'İtalyanca (İtalya)', 'locale' => 'it_IT'],
            ['name' => 'Portekizce (Portekiz)', 'locale' => 'pt_PT'],
            ['name' => 'Portekizce (Brezilya)', 'locale' => 'pt_BR'],
            ['name' => 'Rusça (Rusya)', 'locale' => 'ru_RU'],
            ['name' => 'Arapça (Suudi Arabistan)', 'locale' => 'ar_SA'],
            ['name' => 'Japonca (Japonya)', 'locale' => 'ja_JP'],
            ['name' => 'Çince (Basitleştirilmiş)', 'locale' => 'zh_CN'],
            ['name' => 'Çince (Geleneksel - Tayvan)', 'locale' => 'zh_TW'],
            ['name' => 'Korece (Güney Kore)', 'locale' => 'ko_KR'],
            ['name' => 'Hintçe (Hindistan)', 'locale' => 'hi_IN'],
        ];

        foreach ($languages as $lang) {
            $checkLanguage = Languages::where('locale', $lang['locale'])->first();
            if (!$checkLanguage) {
                $newLanguage = new Languages();
                $newLanguage->name = $lang['name'];
                $newLanguage->locale = $lang['locale'];
                $newLanguage->status = true;
                $newLanguage->save();

                $filePath = base_path('lang/' . $lang['locale'] . '.json');
                if (!File::exists($filePath)) {
                    $jsonContent = json_encode([
                        'welcome' => "Welcome message for {$lang['name']}",
                        'hello' => "Hello from {$lang['name']}"
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

                    File::put($filePath, $jsonContent);
                }
            }
        }
    }
}

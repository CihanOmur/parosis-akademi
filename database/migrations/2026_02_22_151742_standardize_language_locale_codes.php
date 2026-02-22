<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Old locale → new locale mapping
     */
    private array $map = [
        'tr_TR' => 'tr',
        'en_US' => 'en',
        'en_GB' => 'en-gb',
        'ar_SA' => 'ar',
        'de_DE' => 'de',
        'fr_FR' => 'fr',
        'es_ES' => 'es',
        'es_MX' => 'es-mx',
        'it_IT' => 'it',
        'pt_PT' => 'pt',
        'pt_BR' => 'pt-br',
        'ru_RU' => 'ru',
        'zh_CN' => 'zh-cn',
        'zh_TW' => 'zh-tw',
        'ja_JP' => 'ja',
        'ko_KR' => 'ko',
        'hi_IN' => 'hi',
        'nl_NL' => 'nl',
        'pl_PL' => 'pl',
        'sv_SE' => 'sv',
        'fa_IR' => 'fa',
        'ur_PK' => 'ur',
    ];

    public function up(): void
    {
        $rows = DB::table('languages')->get(['id', 'locale', 'name']);

        foreach ($rows as $row) {
            $newLocale = $this->map[$row->locale] ?? $row->locale;

            // Re-key the JSON name translations
            $translations = json_decode($row->name, true) ?? [];
            $newTranslations = [];
            foreach ($translations as $oldKey => $value) {
                $newKey = $this->map[$oldKey] ?? $oldKey;
                $newTranslations[$newKey] = $value;
            }

            DB::table('languages')->where('id', $row->id)->update([
                'locale' => $newLocale,
                'name'   => json_encode($newTranslations, JSON_UNESCAPED_UNICODE),
            ]);
        }
    }

    public function down(): void
    {
        $reverseMap = array_flip($this->map);

        $rows = DB::table('languages')->get(['id', 'locale', 'name']);

        foreach ($rows as $row) {
            $oldLocale = $reverseMap[$row->locale] ?? $row->locale;

            $translations = json_decode($row->name, true) ?? [];
            $oldTranslations = [];
            foreach ($translations as $newKey => $value) {
                $oldKey = $reverseMap[$newKey] ?? $newKey;
                $oldTranslations[$oldKey] = $value;
            }

            DB::table('languages')->where('id', $row->id)->update([
                'locale' => $oldLocale,
                'name'   => json_encode($oldTranslations, JSON_UNESCAPED_UNICODE),
            ]);
        }
    }
};

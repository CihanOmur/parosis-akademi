<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // Genel
            ['group' => 'general', 'key' => 'site_name',        'value' => 'Parosis Akademi'],
            ['group' => 'general', 'key' => 'site_description', 'value' => 'Geleceğin teknolojisine yön veren akademi.'],
            ['group' => 'general', 'key' => 'site_phone',       'value' => ''],
            ['group' => 'general', 'key' => 'site_email',       'value' => ''],
            ['group' => 'general', 'key' => 'site_address',     'value' => ''],
            ['group' => 'general', 'key' => 'copyright_text',   'value' => '© 2026 Parosis Akademi. Tüm hakları saklıdır.'],
            ['group' => 'general', 'key' => 'timezone',         'value' => 'Europe/Istanbul'],

            // Logolar
            ['group' => 'logos', 'key' => 'header_logo', 'value' => ''],
            ['group' => 'logos', 'key' => 'footer_logo', 'value' => ''],
            ['group' => 'logos', 'key' => 'favicon',     'value' => ''],
            ['group' => 'logos', 'key' => 'admin_logo',  'value' => ''],

            // SEO
            ['group' => 'seo', 'key' => 'meta_title',            'value' => 'Parosis Akademi'],
            ['group' => 'seo', 'key' => 'meta_description',      'value' => ''],
            ['group' => 'seo', 'key' => 'meta_keywords',         'value' => ''],
            ['group' => 'seo', 'key' => 'google_analytics_id',   'value' => ''],
            ['group' => 'seo', 'key' => 'google_tag_manager_id', 'value' => ''],
            ['group' => 'seo', 'key' => 'sitemap_url',           'value' => '/sitemap.xml'],
            ['group' => 'seo', 'key' => 'robots_txt',            'value' => "User-agent: *\nAllow: /"],

            // E-posta
            ['group' => 'mail', 'key' => 'mail_mailer',       'value' => 'log'],
            ['group' => 'mail', 'key' => 'mail_host',         'value' => ''],
            ['group' => 'mail', 'key' => 'mail_port',         'value' => '587'],
            ['group' => 'mail', 'key' => 'mail_username',     'value' => ''],
            ['group' => 'mail', 'key' => 'mail_password',     'value' => ''],
            ['group' => 'mail', 'key' => 'mail_encryption',   'value' => 'tls'],
            ['group' => 'mail', 'key' => 'mail_from_address', 'value' => ''],
            ['group' => 'mail', 'key' => 'mail_from_name',    'value' => 'Parosis Akademi'],

            // Sosyal Medya
            ['group' => 'social', 'key' => 'facebook_url',    'value' => ''],
            ['group' => 'social', 'key' => 'twitter_url',     'value' => ''],
            ['group' => 'social', 'key' => 'instagram_url',   'value' => ''],
            ['group' => 'social', 'key' => 'linkedin_url',    'value' => ''],
            ['group' => 'social', 'key' => 'youtube_url',     'value' => ''],
            ['group' => 'social', 'key' => 'tiktok_url',      'value' => ''],
            ['group' => 'social', 'key' => 'whatsapp_number', 'value' => ''],

            // Gelişmiş
            ['group' => 'advanced', 'key' => 'maintenance_mode', 'value' => '0'],
            ['group' => 'advanced', 'key' => 'custom_head_code', 'value' => ''],
            ['group' => 'advanced', 'key' => 'custom_body_code', 'value' => ''],
        ];

        foreach ($defaults as $setting) {
            Setting::firstOrCreate(
                ['group' => $setting['group'], 'key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}

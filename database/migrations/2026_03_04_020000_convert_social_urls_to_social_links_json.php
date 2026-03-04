<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First, migrate existing data to JSON
        $rows = DB::table('footer_page_infos')->get();
        $socialData = [];

        foreach ($rows as $row) {
            $links = [];
            $map = [
                'facebook_url'  => ['name' => 'Facebook',  'icon' => 'assets-front/img/icons/icon-dark-facebook.svg'],
                'twitter_url'   => ['name' => 'Twitter',   'icon' => 'assets-front/img/icons/icon-dark-twitter.svg'],
                'instagram_url' => ['name' => 'Instagram', 'icon' => 'assets-front/img/icons/icon-dark-instagram.svg'],
                'dribbble_url'  => ['name' => 'Dribbble',  'icon' => 'assets-front/img/icons/icon-dark-dribbble.svg'],
                'youtube_url'   => ['name' => 'YouTube',   'icon' => 'assets-front/img/icons/icon-dark-youtube.svg'],
                'linkedin_url'  => ['name' => 'LinkedIn',  'icon' => 'assets-front/img/icons/icon-dark-linkedin.svg'],
            ];

            foreach ($map as $col => $meta) {
                if (!empty($row->$col)) {
                    $links[] = [
                        'name' => $meta['name'],
                        'url'  => $row->$col,
                        'icon' => $meta['icon'],
                    ];
                }
            }

            $socialData[$row->id] = $links;
        }

        // Add new column
        Schema::table('footer_page_infos', function (Blueprint $table) {
            $table->json('social_links')->nullable()->after('address_label');
        });

        // Populate new column
        foreach ($socialData as $id => $links) {
            DB::table('footer_page_infos')
                ->where('id', $id)
                ->update(['social_links' => json_encode($links)]);
        }

        // Drop old columns
        Schema::table('footer_page_infos', function (Blueprint $table) {
            $table->dropColumn([
                'facebook_url', 'twitter_url', 'instagram_url',
                'dribbble_url', 'youtube_url', 'linkedin_url',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('footer_page_infos', function (Blueprint $table) {
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('dribbble_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('linkedin_url')->nullable();
        });

        Schema::table('footer_page_infos', function (Blueprint $table) {
            $table->dropColumn('social_links');
        });
    }
};

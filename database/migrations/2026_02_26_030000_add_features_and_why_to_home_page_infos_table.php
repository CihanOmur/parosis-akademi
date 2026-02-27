<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            // Features Section (3 items: icon, bg_color, title, description)
            $table->json('features')->nullable()->after('categories_button_url');

            // Why Choose Us Section
            $table->json('why_label')->nullable();
            $table->json('why_title')->nullable();
            $table->json('why_description')->nullable();
            $table->json('why_items')->nullable(); // [{title, description, icon, bg_color}]
            $table->string('why_image')->nullable();
            $table->string('why_stat_number')->nullable();
            $table->json('why_stat_text')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            $table->dropColumn([
                'features',
                'why_label', 'why_title', 'why_description',
                'why_items', 'why_image', 'why_stat_number', 'why_stat_text',
            ]);
        });
    }
};

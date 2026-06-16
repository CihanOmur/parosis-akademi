<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            // Diğer page tablolarıyla aynı CTA şeması (footer üst CTA bloğu için)
            $table->text('cta_label')->nullable()->after('testimonial_stat_text');
            $table->text('cta_title')->nullable()->after('cta_label');
            $table->text('cta_description')->nullable()->after('cta_title');
            $table->text('cta_button_text')->nullable()->after('cta_description');
            $table->string('cta_button_url', 500)->nullable()->after('cta_button_text');
            $table->string('cta_image', 500)->nullable()->after('cta_button_url');
        });
    }

    public function down(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            $table->dropColumn(['cta_label', 'cta_title', 'cta_description', 'cta_button_text', 'cta_button_url', 'cta_image']);
        });
    }
};

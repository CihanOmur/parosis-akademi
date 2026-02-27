<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us_page_infos', function (Blueprint $table) {
            $table->string('faq_image1')->nullable()->after('faq_title');
            $table->string('faq_image2')->nullable()->after('faq_image1');
            $table->string('faq_image3')->nullable()->after('faq_image2');
        });
    }

    public function down(): void
    {
        Schema::table('about_us_page_infos', function (Blueprint $table) {
            $table->dropColumn(['faq_image1', 'faq_image2', 'faq_image3']);
        });
    }
};

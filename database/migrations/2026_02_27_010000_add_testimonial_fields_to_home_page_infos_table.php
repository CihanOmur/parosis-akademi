<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            $table->json('testimonial_label')->nullable();
            $table->json('testimonial_title')->nullable();
            $table->string('testimonial_image')->nullable();
            $table->string('testimonial_stat_number')->nullable();
            $table->json('testimonial_stat_text')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            $table->dropColumn([
                'testimonial_label',
                'testimonial_title',
                'testimonial_image',
                'testimonial_stat_number',
                'testimonial_stat_text',
            ]);
        });
    }
};

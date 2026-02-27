<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us_page_infos', function (Blueprint $table) {
            $table->id();

            // Breadcrumb
            $table->json('breadcrumb_title')->nullable();
            $table->json('breadcrumb_home')->nullable();
            $table->json('breadcrumb_current')->nullable();

            // Section 1 — Why Choose Us
            $table->json('section1_label')->nullable();
            $table->json('section1_title')->nullable();
            $table->json('section1_description')->nullable();
            $table->json('section1_feature1_title')->nullable();
            $table->json('section1_feature1_description')->nullable();
            $table->string('section1_feature1_icon')->nullable();
            $table->json('section1_feature2_title')->nullable();
            $table->json('section1_feature2_description')->nullable();
            $table->string('section1_feature2_icon')->nullable();
            $table->string('section1_image1')->nullable();
            $table->string('section1_image2')->nullable();
            $table->string('section1_stat_number')->nullable();
            $table->json('section1_stat_text')->nullable();

            // Course Categories section
            $table->json('categories_label')->nullable();
            $table->json('categories_title')->nullable();
            $table->json('categories_button_text')->nullable();

            // Video section
            $table->string('video_image')->nullable();
            $table->string('video_url')->nullable();

            // Client Logos section
            $table->json('logos_text')->nullable();

            // CTA (Purple section — Online Courses)
            $table->json('cta_label')->nullable();
            $table->json('cta_title')->nullable();
            $table->json('cta_description')->nullable();
            $table->json('cta_button_text')->nullable();
            $table->string('cta_image')->nullable();

            // Section 2 — Why Choose (second block)
            $table->json('section2_label')->nullable();
            $table->json('section2_title')->nullable();
            $table->json('section2_description')->nullable();
            $table->json('section2_features')->nullable();
            $table->string('section2_image')->nullable();
            $table->string('section2_stat_number')->nullable();
            $table->json('section2_stat_text')->nullable();

            // Testimonials section
            $table->json('testimonial_label')->nullable();
            $table->json('testimonial_title')->nullable();

            // FAQ section
            $table->json('faq_label')->nullable();
            $table->json('faq_title')->nullable();

            // Blog section
            $table->json('blog_label')->nullable();
            $table->json('blog_title')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us_page_infos');
    }
};

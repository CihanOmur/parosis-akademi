<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_page_infos', function (Blueprint $table) {
            $table->id();

            // Logo
            $table->string('logo')->nullable();

            // Translatable text fields (json for Spatie)
            $table->json('about_text')->nullable();
            $table->json('links_title')->nullable();
            $table->json('contact_title')->nullable();
            $table->json('newsletter_title')->nullable();
            $table->json('newsletter_text')->nullable();
            $table->json('newsletter_button')->nullable();
            $table->json('newsletter_placeholder')->nullable();
            $table->json('copyright_text')->nullable();
            $table->json('support_label')->nullable();
            $table->json('email_label')->nullable();
            $table->json('address_label')->nullable();

            // Social media URLs
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('dribbble_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('linkedin_url')->nullable();

            // Navigation links: [{label: {tr: "...", en: "..."}, url: "/about"}]
            $table->json('nav_links')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_page_infos');
    }
};

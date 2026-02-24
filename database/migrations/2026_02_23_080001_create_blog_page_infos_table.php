<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_page_infos', function (Blueprint $table) {
            $table->id();

            // Translatable fields (JSON)
            $table->json('title')->nullable();
            $table->json('breadcrumb_home')->nullable();
            $table->json('breadcrumb_current')->nullable();
            $table->json('detail_breadcrumb_current')->nullable();

            // Sidebar titles
            $table->json('sidebar_search_title')->nullable();
            $table->json('sidebar_categories_title')->nullable();
            $table->json('sidebar_popular_title')->nullable();
            $table->json('sidebar_contact_title')->nullable();
            $table->json('sidebar_tags_title')->nullable();

            // Sidebar contact info
            $table->json('sidebar_contact_phone_label')->nullable();
            $table->json('sidebar_contact_phone')->nullable();
            $table->json('sidebar_contact_email_label')->nullable();
            $table->json('sidebar_contact_email')->nullable();
            $table->json('sidebar_contact_address_label')->nullable();
            $table->json('sidebar_contact_address')->nullable();

            // CTA fields
            $table->json('cta_label')->nullable();
            $table->json('cta_title')->nullable();
            $table->json('cta_description')->nullable();
            $table->json('cta_button_text')->nullable();

            // Non-translatable
            $table->string('cta_button_url')->nullable();
            $table->string('cta_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_page_infos');
    }
};

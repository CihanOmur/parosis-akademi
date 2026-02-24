<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faq_page_infos', function (Blueprint $table) {
            $table->id();

            // Translatable fields (stored as JSON)
            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
            $table->json('description')->nullable();
            $table->json('breadcrumb_home')->nullable();
            $table->json('breadcrumb_current')->nullable();
            $table->json('section_label')->nullable();
            $table->json('section_title')->nullable();
            $table->json('cta_label')->nullable();
            $table->json('cta_title')->nullable();
            $table->json('cta_description')->nullable();
            $table->json('cta_button_text')->nullable();
            $table->json('form_title')->nullable();
            $table->json('form_description')->nullable();
            $table->json('form_name_placeholder')->nullable();
            $table->json('form_email_placeholder')->nullable();
            $table->json('form_message_placeholder')->nullable();
            $table->json('form_privacy_text')->nullable();
            $table->json('form_button_text')->nullable();

            // Non-translatable fields
            $table->string('cta_button_url')->nullable();
            $table->string('cta_image')->nullable();
            $table->string('contact_form_image')->nullable();
            $table->string('form_action_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faq_page_infos');
    }
};

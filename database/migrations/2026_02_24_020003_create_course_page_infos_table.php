<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_page_infos', function (Blueprint $table) {
            $table->id();

            // Breadcrumb
            $table->json('title')->nullable();
            $table->json('breadcrumb_home')->nullable();
            $table->json('breadcrumb_current')->nullable();
            $table->json('detail_breadcrumb_current')->nullable();

            // Search section
            $table->json('search_placeholder')->nullable();
            $table->json('search_button_text')->nullable();

            // Detail section titles
            $table->json('detail_what_learn_title')->nullable();
            $table->json('detail_why_choose_title')->nullable();

            // Sidebar: Course Info labels
            $table->json('sidebar_info_title')->nullable();
            $table->json('sidebar_price_label')->nullable();
            $table->json('sidebar_instructor_label')->nullable();
            $table->json('sidebar_certification_label')->nullable();
            $table->json('sidebar_lessons_label')->nullable();
            $table->json('sidebar_duration_label')->nullable();
            $table->json('sidebar_language_label')->nullable();
            $table->json('sidebar_students_label')->nullable();

            // Sidebar: Contact
            $table->json('sidebar_contact_title')->nullable();
            $table->json('sidebar_contact_phone_label')->nullable();
            $table->json('sidebar_contact_phone')->nullable();
            $table->json('sidebar_contact_email_label')->nullable();
            $table->json('sidebar_contact_email')->nullable();
            $table->json('sidebar_contact_address_label')->nullable();
            $table->json('sidebar_contact_address')->nullable();

            // CTA
            $table->json('cta_label')->nullable();
            $table->json('cta_title')->nullable();
            $table->json('cta_description')->nullable();
            $table->json('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_page_infos');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_page_infos', function (Blueprint $table) {
            $table->id();

            // Translatable fields (json)
            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
            $table->json('breadcrumb_home')->nullable();
            $table->json('breadcrumb_current')->nullable();
            $table->json('detail_breadcrumb_current')->nullable();
            $table->json('cta_label')->nullable();
            $table->json('cta_title')->nullable();
            $table->json('cta_description')->nullable();
            $table->json('cta_button_text')->nullable();

            // Non-translatable fields
            $table->string('cta_button_url')->nullable();
            $table->string('cta_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_page_infos');
    }
};

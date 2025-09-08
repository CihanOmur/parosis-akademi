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
        Schema::create('services_page_infos', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
            $table->json('description')->nullable();

            $table->json('info_title')->nullable();
            $table->json('info_subtitle')->nullable();
            $table->json('info_description')->nullable();
            $table->json('info_skil_column_1')->nullable();
            $table->json('info_skil_column_2')->nullable();
            $table->json('info_skil_column_3')->nullable();
            $table->string('info_image_url', 230)->nullable();

            $table->json('faq_title')->nullable();
            $table->json('faq_ids')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_page_infos');
    }
};

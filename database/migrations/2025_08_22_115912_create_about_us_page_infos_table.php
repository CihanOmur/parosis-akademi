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
        Schema::create('about_us_page_infos', function (Blueprint $table) {
            $table->id();

            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
            $table->json('description')->nullable();

            $table->json('mision_title')->nullable();
            $table->json('mision_description_1')->nullable();
            $table->json('mision_description_2')->nullable();

            $table->json('gallery_title')->nullable();
            $table->json('gallery_subtitle')->nullable();

            $table->json('references_title')->nullable();
            $table->json('references_subtitle')->nullable();
            $table->json('references_ids')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_page_infos');
    }
};

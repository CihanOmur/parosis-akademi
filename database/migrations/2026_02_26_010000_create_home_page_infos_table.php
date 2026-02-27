<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_page_infos', function (Blueprint $table) {
            $table->id();

            // Welcome Section
            $table->json('welcome_label')->nullable();
            $table->json('welcome_title')->nullable();
            $table->json('welcome_description')->nullable();
            $table->json('welcome_features')->nullable();
            $table->string('welcome_image')->nullable();
            $table->string('welcome_stat_number')->nullable();
            $table->json('welcome_stat_text')->nullable();

            // Course Categories Section
            $table->json('categories_label')->nullable();
            $table->json('categories_title')->nullable();
            $table->json('categories_button_text')->nullable();

            // Courses Section
            $table->json('courses_label')->nullable();
            $table->json('courses_title')->nullable();

            // Blog Section
            $table->json('blog_label')->nullable();
            $table->json('blog_title')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_page_infos');
    }
};

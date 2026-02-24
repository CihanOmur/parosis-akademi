<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Translatable fields (JSON)
            $table->json('title')->nullable();
            $table->json('short_description')->nullable();
            $table->json('content')->nullable();
            $table->json('what_you_learn')->nullable();
            $table->json('why_choose')->nullable();

            // Non-translatable
            $table->string('image')->nullable();
            $table->string('inner_image')->nullable();
            $table->string('price')->nullable();
            $table->string('duration')->nullable();
            $table->integer('lesson_count')->nullable();
            $table->string('language')->nullable();
            $table->integer('student_count')->nullable();
            $table->boolean('has_certification')->default(false);
            $table->string('instructor_name')->nullable();
            $table->string('instructor_image')->nullable();

            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->dateTime('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

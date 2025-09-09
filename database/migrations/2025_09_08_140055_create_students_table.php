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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->enum('registration_type', ['1', '2']);
            $table->string('full_name')->nullable();
            $table->enum('gender', ['Erkek', 'Kadın']);
            $table->date('birth_date')->nullable();
            $table->string('school_name')->nullable();
            $table->string('national_id')->nullable();
            $table->string('blood_type')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('class_id');
            $table->boolean('has_allergy')->default(false);
            $table->text('allergy_detail')->nullable();
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('lesson_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

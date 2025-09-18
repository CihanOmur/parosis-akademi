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
        Schema::create('lesson_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Sınıf adı
            $table->string('day', 230)->nullable(); // Günü
            $table->time('time')->default('07:00:00'); // Saati
            $table->time('end_time')->default('07:00:00'); // Saati
            $table->decimal('price', 12, 2); // Ücret
            $table->unsignedInteger('quota'); // Kontenjan
            $table->string('teacher_id'); // Öğretmen
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('course_time', 230)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_classes');
    }
};

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
            $table->string('name'); // Sınıf adı
            $table->enum('day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']); // Günü
            $table->time('time'); // Saati
            $table->decimal('price', 8, 2); // Ücret
            $table->unsignedInteger('quota'); // Kontenjan
            $table->string('teacher_name'); // Öğretmen adı (text)
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

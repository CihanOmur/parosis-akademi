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
        Schema::create('lesson_class_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_class_id')->nullable();
            $table->string('day', 230)->nullable(); // Günü
            $table->time('start_time')->default('07:00:00'); // Saati
            $table->time('end_time')->default('07:00:00'); // Saati
            $table->foreign('lesson_class_id')->references('id')->on('lesson_classes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_class_days');
    }
};

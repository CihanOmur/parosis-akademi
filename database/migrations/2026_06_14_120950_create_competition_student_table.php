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
        Schema::create('competition_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('competition_id')->constrained('competitions')->cascadeOnDelete();

            // Statüler
            $table->string('parent_consent_status', 20)->default('bekliyor');
            $table->string('passport_status', 20)->default('yok');
            $table->string('visa_status', 20)->default('gerekli_degil');
            $table->string('payment_status', 20)->default('bekliyor');

            // Ücret
            $table->decimal('payment_amount', 10, 2)->nullable();
            $table->string('payment_currency', 5)->default('TRY');

            // Sonuç
            $table->unsignedInteger('result_rank')->nullable();
            $table->string('result_label', 100)->nullable();
            $table->text('result_notes')->nullable();

            $table->date('joined_at')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'competition_id']);
            $table->index('result_rank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_student');
    }
};

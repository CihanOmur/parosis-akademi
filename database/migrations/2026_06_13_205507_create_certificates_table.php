<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            // kurumsal | danismanlik | yarisma
            $table->string('type', 20)->index();

            // Sertifika / başarı adı (örn. "Fibonacci Katılım Sertifikası")
            $table->string('name', 200);

            // type = danismanlik ise dropdown'dan seçilen kurum
            $table->foreignId('consulting_institution_id')
                ->nullable()
                ->constrained('consulting_institutions')
                ->nullOnDelete();

            // type = yarisma ise serbest metin (yarışma adı / kurum)
            $table->string('issuer_text', 200)->nullable();

            // Branş — kurs kategorileri kullanılır (Çizgi İzleyen, Mini Sumo, STEM, Python ...)
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('course_categories')
                ->nullOnDelete();

            $table->date('issue_date');
            $table->string('certificate_number', 100)->nullable();
            $table->string('file_path', 255)->nullable(); // PDF / PNG / JPEG
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['student_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};

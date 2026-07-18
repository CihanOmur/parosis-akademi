<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->nullOnDelete();
            $table->string('student_name');
            $table->unsignedTinyInteger('student_age');
            $table->string('school');
            $table->string('grade');
            $table->string('parent_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('status')->default('pending');
            $table->text('note')->nullable();
            $table->timestamp('contacted_at')->nullable();
            $table->timestamps();

            $table->index(['course_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_applications');
    }
};

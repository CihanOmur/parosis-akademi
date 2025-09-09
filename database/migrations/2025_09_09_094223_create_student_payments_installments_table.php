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
        Schema::create('student_payments_installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('student_payment_id');
            $table->integer('order')->unsigned()->nullable();
            $table->date('payment_date')->nullable();
            $table->string('installment_price', 230)->nullable()->default('0');
            $table->string('payed_price', 230)->nullable()->default('0');
            $table->string('payment_type', 230)->nullable()->default('Nakit');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('student_payment_id')->references('id')->on('student_payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_payments_installments');
    }
};

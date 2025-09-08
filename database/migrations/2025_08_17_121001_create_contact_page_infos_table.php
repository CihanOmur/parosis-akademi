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
        Schema::create('contact_page_infos', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
            $table->json('description')->nullable();

            $table->json('form_title')->nullable();
            $table->json('form_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_page_infos');
    }
};

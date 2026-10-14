<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('privacy_page_infos', function (Blueprint $table) {
            $table->id();

            // Translatable fields (stored as JSON)
            $table->json('title')->nullable();
            $table->json('breadcrumb_home')->nullable();
            $table->json('breadcrumb_current')->nullable();
            $table->json('content')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('privacy_page_infos');
    }
};

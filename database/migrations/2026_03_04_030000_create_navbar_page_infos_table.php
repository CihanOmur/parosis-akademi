<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navbar_page_infos', function (Blueprint $table) {
            $table->id();

            // Nested menu tree: [{label: {tr: "...", en: "..."}, url: "/", children: [...]}]
            $table->json('nav_items')->nullable();

            // Translatable text fields
            $table->json('search_placeholder')->nullable();
            $table->json('search_button_text')->nullable();
            $table->json('register_button_text')->nullable();
            $table->json('login_button_text')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navbar_page_infos');
    }
};

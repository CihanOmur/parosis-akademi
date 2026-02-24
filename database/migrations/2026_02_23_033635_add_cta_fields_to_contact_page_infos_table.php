<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->json('cta_label')->nullable();
            $table->json('cta_title')->nullable();
            $table->json('cta_description')->nullable();
            $table->json('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->dropColumn(['cta_label', 'cta_title', 'cta_description', 'cta_button_text', 'cta_button_url', 'cta_image']);
        });
    }
};

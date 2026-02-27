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
        Schema::table('home_page_infos', function (Blueprint $table) {
            $table->string('funfact_image')->nullable()->after('client_logo_text');
            $table->json('funfact_items')->nullable()->after('funfact_image');
        });
    }

    public function down(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            $table->dropColumn(['funfact_image', 'funfact_items']);
        });
    }
};

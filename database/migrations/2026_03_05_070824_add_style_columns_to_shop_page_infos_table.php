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
        Schema::table('shop_page_infos', function (Blueprint $table) {
            $table->json('field_styles')->nullable();
            $table->json('default_styles')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('shop_page_infos', function (Blueprint $table) {
            $table->dropColumn(['field_styles', 'default_styles']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            $table->string('categories_button_url')->nullable()->after('categories_button_text');
        });
    }

    public function down(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            $table->dropColumn('categories_button_url');
        });
    }
};

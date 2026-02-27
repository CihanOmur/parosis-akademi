<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us_page_infos', function (Blueprint $table) {
            $table->json('section1_features')->nullable()->after('section1_description');
        });
    }

    public function down(): void
    {
        Schema::table('about_us_page_infos', function (Blueprint $table) {
            $table->dropColumn('section1_features');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_page_infos', function (Blueprint $table) {
            $table->json('title_style')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('course_page_infos', function (Blueprint $table) {
            $table->dropColumn('title_style');
        });
    }
};

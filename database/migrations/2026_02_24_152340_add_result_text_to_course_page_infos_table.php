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
        Schema::table('course_page_infos', function (Blueprint $table) {
            $table->json('result_text')->nullable()->after('search_button_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_page_infos', function (Blueprint $table) {
            $table->dropColumn('result_text');
        });
    }
};

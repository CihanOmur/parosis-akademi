<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teacher_page_infos', function (Blueprint $table) {
            $table->json('default_styles')->nullable()->after('field_styles');
        });
    }

    public function down(): void
    {
        Schema::table('teacher_page_infos', function (Blueprint $table) {
            $table->dropColumn('default_styles');
        });
    }
};

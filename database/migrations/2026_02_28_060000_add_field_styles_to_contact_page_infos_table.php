<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->json('field_styles')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->dropColumn('field_styles');
        });
    }
};

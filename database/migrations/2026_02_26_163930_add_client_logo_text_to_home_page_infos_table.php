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
            $table->text('client_logo_text')->nullable()->after('why_stat_text');
        });
    }

    public function down(): void
    {
        Schema::table('home_page_infos', function (Blueprint $table) {
            $table->dropColumn('client_logo_text');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_page_infos', function (Blueprint $table) {
            $table->json('sidebar_search_placeholder')->nullable()->after('sidebar_search_title');
        });
    }

    public function down(): void
    {
        Schema::table('blog_page_infos', function (Blueprint $table) {
            $table->dropColumn('sidebar_search_placeholder');
        });
    }
};

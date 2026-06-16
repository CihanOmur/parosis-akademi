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
            if (!Schema::hasColumn('shop_page_infos', 'breadcrumb_bg_color')) {
                $table->string('breadcrumb_bg_color', 20)->nullable()->after('id');
            }
            if (!Schema::hasColumn('shop_page_infos', 'breadcrumb_bg_image')) {
                $table->string('breadcrumb_bg_image', 500)->nullable()->after('breadcrumb_bg_color');
            }
        });
    }

    public function down(): void
    {
        Schema::table('shop_page_infos', function (Blueprint $table) {
            if (Schema::hasColumn('shop_page_infos', 'breadcrumb_bg_color')) {
                $table->dropColumn('breadcrumb_bg_color');
            }
            if (Schema::hasColumn('shop_page_infos', 'breadcrumb_bg_image')) {
                $table->dropColumn('breadcrumb_bg_image');
            }
        });
    }
};

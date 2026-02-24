<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->json('breadcrumb_home')->nullable();
            $table->json('breadcrumb_current')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('contact_page_infos', function (Blueprint $table) {
            $table->dropColumn(['breadcrumb_home', 'breadcrumb_current']);
        });
    }
};

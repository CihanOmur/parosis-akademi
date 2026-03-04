<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('navbar_page_infos', function (Blueprint $table) {
            $table->boolean('show_search')->default(true)->after('login_button_text');
            $table->boolean('show_register_button')->default(true)->after('show_search');
            $table->boolean('show_login_button')->default(true)->after('show_register_button');
            $table->boolean('show_social_links')->default(true)->after('show_login_button');
            $table->boolean('show_cart_button')->default(true)->after('show_social_links');
            $table->boolean('show_side_info_button')->default(true)->after('show_cart_button');
        });
    }

    public function down(): void
    {
        Schema::table('navbar_page_infos', function (Blueprint $table) {
            $table->dropColumn([
                'show_search', 'show_register_button', 'show_login_button',
                'show_social_links', 'show_cart_button', 'show_side_info_button',
            ]);
        });
    }
};

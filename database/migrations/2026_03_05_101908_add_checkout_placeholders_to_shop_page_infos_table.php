<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shop_page_infos', function (Blueprint $table) {
            // Input placeholder'ları
            $table->json('checkout_card_number_ph')->nullable();
            $table->json('checkout_card_name_ph')->nullable();
            $table->json('checkout_card_expiry_ph')->nullable();
            $table->json('checkout_card_cvv_ph')->nullable();
            $table->json('checkout_name_ph')->nullable();
            $table->json('checkout_email_ph')->nullable();
            $table->json('checkout_phone_ph')->nullable();
            $table->json('checkout_address_ph')->nullable();
            $table->json('checkout_city_ph')->nullable();
            $table->json('checkout_district_ph')->nullable();
            $table->json('checkout_note_ph')->nullable();
            // Kart preview & ek metinler
            $table->json('checkout_card_preview_name')->nullable();
            $table->json('checkout_optional_text')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('shop_page_infos', function (Blueprint $table) {
            $table->dropColumn([
                'checkout_card_number_ph', 'checkout_card_name_ph',
                'checkout_card_expiry_ph', 'checkout_card_cvv_ph',
                'checkout_name_ph', 'checkout_email_ph',
                'checkout_phone_ph', 'checkout_address_ph',
                'checkout_city_ph', 'checkout_district_ph',
                'checkout_note_ph',
                'checkout_card_preview_name', 'checkout_optional_text',
            ]);
        });
    }
};

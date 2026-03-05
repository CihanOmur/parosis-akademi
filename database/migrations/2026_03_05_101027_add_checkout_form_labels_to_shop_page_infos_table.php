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
            // Ödeme formu label'ları
            $table->json('checkout_card_number_label')->nullable();
            $table->json('checkout_card_name_label')->nullable();
            $table->json('checkout_card_expiry_label')->nullable();
            $table->json('checkout_card_cvv_label')->nullable();
            $table->json('checkout_card_holder_label')->nullable();
            $table->json('checkout_card_expiry_preview')->nullable();
            $table->json('checkout_name_label')->nullable();
            $table->json('checkout_email_label')->nullable();
            $table->json('checkout_phone_label')->nullable();
            $table->json('checkout_address_label')->nullable();
            $table->json('checkout_city_label')->nullable();
            $table->json('checkout_district_label')->nullable();
            $table->json('checkout_note_label')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('shop_page_infos', function (Blueprint $table) {
            $table->dropColumn([
                'checkout_card_number_label', 'checkout_card_name_label',
                'checkout_card_expiry_label', 'checkout_card_cvv_label',
                'checkout_card_holder_label', 'checkout_card_expiry_preview',
                'checkout_name_label', 'checkout_email_label',
                'checkout_phone_label', 'checkout_address_label',
                'checkout_city_label', 'checkout_district_label',
                'checkout_note_label',
            ]);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_page_infos', function (Blueprint $table) {
            $table->id();

            // ── Ürünler Listesi ──
            $table->json('products_title')->nullable();
            $table->json('products_breadcrumb_home')->nullable();
            $table->json('products_breadcrumb_current')->nullable();
            $table->json('products_search_placeholder')->nullable();
            $table->json('products_search_button')->nullable();
            $table->json('products_all_text')->nullable();
            $table->json('products_add_to_cart')->nullable();
            $table->json('products_detail_button')->nullable();
            $table->json('products_empty_text')->nullable();

            // ── Ürün Detay ──
            $table->json('detail_title')->nullable();
            $table->json('detail_breadcrumb_products')->nullable();
            $table->json('detail_discount_text')->nullable();
            $table->json('detail_add_to_cart')->nullable();
            $table->json('detail_sku_label')->nullable();
            $table->json('detail_category_label')->nullable();
            $table->json('detail_description_tab')->nullable();
            $table->json('detail_features_tab')->nullable();
            $table->json('detail_related_subtitle')->nullable();
            $table->json('detail_related_title')->nullable();
            $table->json('detail_related_button')->nullable();
            $table->json('detail_trust_1')->nullable();
            $table->json('detail_trust_2')->nullable();
            $table->json('detail_trust_3')->nullable();

            // ── Sepet ──
            $table->json('cart_title')->nullable();
            $table->json('cart_breadcrumb_current')->nullable();
            $table->json('cart_empty_title')->nullable();
            $table->json('cart_empty_description')->nullable();
            $table->json('cart_empty_button')->nullable();
            $table->json('cart_items_header')->nullable();
            $table->json('cart_summary_header')->nullable();
            $table->json('cart_subtotal')->nullable();
            $table->json('cart_shipping')->nullable();
            $table->json('cart_shipping_free')->nullable();
            $table->json('cart_total')->nullable();
            $table->json('cart_checkout_button')->nullable();
            $table->json('cart_continue_shopping')->nullable();
            $table->json('cart_coupon_label')->nullable();
            $table->json('cart_coupon_placeholder')->nullable();
            $table->json('cart_coupon_apply')->nullable();
            $table->json('cart_coupon_remove')->nullable();
            $table->json('cart_coupon_discount')->nullable();
            $table->json('cart_trust_1')->nullable();
            $table->json('cart_trust_2')->nullable();
            $table->json('cart_trust_3')->nullable();

            // ── Ödeme ──
            $table->json('checkout_title')->nullable();
            $table->json('checkout_breadcrumb_cart')->nullable();
            $table->json('checkout_breadcrumb_current')->nullable();
            $table->json('checkout_step_1')->nullable();
            $table->json('checkout_step_2')->nullable();
            $table->json('checkout_step_3')->nullable();
            $table->json('checkout_payment_title')->nullable();
            $table->json('checkout_payment_subtitle')->nullable();
            $table->json('checkout_delivery_title')->nullable();
            $table->json('checkout_delivery_subtitle')->nullable();
            $table->json('checkout_submit_button')->nullable();
            $table->json('checkout_summary_header')->nullable();
            $table->json('checkout_ssl_info')->nullable();

            // ── Stil ──
            $table->json('field_styles')->nullable();
            $table->json('default_styles')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_page_infos');
    }
};

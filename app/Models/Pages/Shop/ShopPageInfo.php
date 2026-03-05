<?php

namespace App\Models\Pages\Shop;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ShopPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $casts = [
        'field_styles'   => 'array',
        'default_styles' => 'array',
    ];

    public $translatable = [
        // Ürünler Listesi
        'products_title', 'products_breadcrumb_home', 'products_breadcrumb_current',
        'products_search_placeholder', 'products_search_button', 'products_all_text',
        'products_add_to_cart', 'products_detail_button', 'products_empty_text',

        // Ürün Detay
        'detail_title', 'detail_breadcrumb_products', 'detail_discount_text',
        'detail_add_to_cart', 'detail_sku_label', 'detail_category_label',
        'detail_description_tab', 'detail_features_tab',
        'detail_related_subtitle', 'detail_related_title', 'detail_related_button',
        'detail_trust_1', 'detail_trust_2', 'detail_trust_3',

        // Sepet
        'cart_title', 'cart_breadcrumb_current',
        'cart_empty_title', 'cart_empty_description', 'cart_empty_button',
        'cart_items_header', 'cart_summary_header',
        'cart_subtotal', 'cart_shipping', 'cart_shipping_free', 'cart_total',
        'cart_checkout_button', 'cart_continue_shopping',
        'cart_coupon_label', 'cart_coupon_placeholder', 'cart_coupon_apply',
        'cart_coupon_remove', 'cart_coupon_discount',
        'cart_trust_1', 'cart_trust_2', 'cart_trust_3',

        // Ödeme
        'checkout_title', 'checkout_breadcrumb_cart', 'checkout_breadcrumb_current',
        'checkout_step_1', 'checkout_step_2', 'checkout_step_3',
        'checkout_payment_title', 'checkout_payment_subtitle',
        'checkout_delivery_title', 'checkout_delivery_subtitle',
        'checkout_submit_button', 'checkout_summary_header', 'checkout_ssl_info',

        // Ödeme Form Label'ları
        'checkout_card_number_label', 'checkout_card_name_label',
        'checkout_card_expiry_label', 'checkout_card_cvv_label',
        'checkout_card_holder_label', 'checkout_card_expiry_preview',
        'checkout_name_label', 'checkout_email_label',
        'checkout_phone_label', 'checkout_address_label',
        'checkout_city_label', 'checkout_district_label',
        'checkout_note_label',

        // Ödeme Placeholder'ları
        'checkout_card_number_ph', 'checkout_card_name_ph',
        'checkout_card_expiry_ph', 'checkout_card_cvv_ph',
        'checkout_name_ph', 'checkout_email_ph',
        'checkout_phone_ph', 'checkout_address_ph',
        'checkout_city_ph', 'checkout_district_ph',
        'checkout_note_ph',

        // Kart Preview & Ek Metinler
        'checkout_card_preview_name', 'checkout_optional_text',
    ];
}

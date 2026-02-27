<?php

namespace App\Models\Pages\AboutUs;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutUsPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    protected $casts = [
        'section1_features' => 'array',
    ];

    public $translatable = [
        // Breadcrumb
        'breadcrumb_title',
        'breadcrumb_home',
        'breadcrumb_current',

        // Section 1 — Why Choose Us
        'section1_label',
        'section1_title',
        'section1_description',
        'section1_features',
        'section1_stat_text',

        // Legacy Section 1 feature fields (kept for backward compat)
        'section1_feature1_title',
        'section1_feature1_description',
        'section1_feature2_title',
        'section1_feature2_description',

        // Course Categories
        'categories_label',
        'categories_title',
        'categories_button_text',

        // Client Logos
        'logos_text',

        // CTA (Purple section)
        'cta_label',
        'cta_title',
        'cta_description',
        'cta_button_text',

        // Section 2 — Why Choose (second)
        'section2_label',
        'section2_title',
        'section2_description',
        'section2_features',
        'section2_stat_text',

        // Testimonials
        'testimonial_label',
        'testimonial_title',

        // FAQ
        'faq_label',
        'faq_title',

        // Blog
        'blog_label',
        'blog_title',
    ];
}

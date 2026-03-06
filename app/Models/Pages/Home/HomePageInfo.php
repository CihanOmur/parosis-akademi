<?php

namespace App\Models\Pages\Home;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomePageInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'welcome_label', 'welcome_title', 'welcome_description', 'welcome_features',
        'welcome_image', 'welcome_stat_number', 'welcome_stat_text',
        'categories_label', 'categories_title', 'categories_button_text', 'categories_button_url',
        'courses_label', 'courses_title',
        'blog_label', 'blog_title',
        'features',
        'why_label', 'why_title', 'why_description', 'why_items',
        'why_image', 'why_stat_number', 'why_stat_text',
        'client_logo_text',
        'funfact_image', 'funfact_items',
        'testimonial_label', 'testimonial_title', 'testimonial_image',
        'testimonial_stat_number', 'testimonial_stat_text',
        'field_styles', 'default_styles',
    ];

    protected $casts = [
        'welcome_features' => 'array',
        'features' => 'array',
        'why_items' => 'array',
        'funfact_items' => 'array',
        'field_styles' => 'array',
        'default_styles' => 'array',
    ];

    public $translatable = [
        // Welcome Section
        'welcome_label',
        'welcome_title',
        'welcome_description',
        'welcome_features',
        'welcome_stat_text',

        // Course Categories Section
        'categories_label',
        'categories_title',
        'categories_button_text',

        // Features Section
        'features',

        // Why Choose Us Section
        'why_label',
        'why_title',
        'why_description',
        'why_items',
        'why_stat_text',

        // Fun-Fact Section
        'funfact_items',

        // Client Logo Section
        'client_logo_text',

        // Courses Section
        'courses_label',
        'courses_title',

        // Blog Section
        'blog_label',
        'blog_title',

        // Testimonial Section
        'testimonial_label',
        'testimonial_title',
        'testimonial_stat_text',
    ];
}

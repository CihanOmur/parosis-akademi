<?php

namespace App\Models\Pages\Home;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomePageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

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

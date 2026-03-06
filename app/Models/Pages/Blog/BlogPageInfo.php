<?php

namespace App\Models\Pages\Blog;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BlogPageInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
        'sidebar_search_title', 'sidebar_search_placeholder',
        'sidebar_categories_title', 'sidebar_popular_title',
        'sidebar_contact_title', 'sidebar_tags_title',
        'sidebar_contact_phone_label', 'sidebar_contact_phone',
        'sidebar_contact_email_label', 'sidebar_contact_email',
        'sidebar_contact_address_label', 'sidebar_contact_address',
        'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
        'cta_button_url', 'cta_image',
        'field_styles', 'default_styles',
    ];

    protected $casts = [
        'field_styles' => 'array',
        'default_styles' => 'array',
    ];

    public $translatable = [
        'title', 'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
        'sidebar_search_title', 'sidebar_search_placeholder',
        'sidebar_categories_title', 'sidebar_popular_title',
        'sidebar_contact_title', 'sidebar_tags_title',
        'sidebar_contact_phone_label', 'sidebar_contact_phone',
        'sidebar_contact_email_label', 'sidebar_contact_email',
        'sidebar_contact_address_label', 'sidebar_contact_address',
        'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
    ];
}

<?php

namespace App\Models\Pages\Footer;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FooterPageInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'logo', 'about_text', 'links_title', 'contact_title',
        'newsletter_title', 'newsletter_text', 'newsletter_button', 'newsletter_placeholder',
        'copyright_text', 'support_label', 'email_label', 'address_label',
        'facebook_url', 'twitter_url', 'instagram_url', 'dribbble_url',
        'youtube_url', 'linkedin_url',
        'nav_links',
    ];

    protected $casts = [
        'nav_links' => 'array',
        'social_links' => 'array',
    ];

    public $translatable = [
        'about_text',
        'links_title',
        'contact_title',
        'newsletter_title',
        'newsletter_text',
        'newsletter_button',
        'newsletter_placeholder',
        'copyright_text',
        'support_label',
        'email_label',
        'address_label',
    ];
}

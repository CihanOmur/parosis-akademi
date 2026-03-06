<?php

namespace App\Models\Pages\Faq;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FaqPageInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'subtitle', 'description',
        'breadcrumb_home', 'breadcrumb_current',
        'section_label', 'section_title',
        'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
        'cta_button_url', 'cta_image',
        'form_title', 'form_description',
        'form_name_placeholder', 'form_email_placeholder', 'form_message_placeholder',
        'form_privacy_text', 'form_button_text',
        'contact_form_image', 'form_action_url',
        'field_styles', 'default_styles',
    ];

    protected $casts = [
        'field_styles' => 'array',
        'default_styles' => 'array',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'description',
        'breadcrumb_home',
        'breadcrumb_current',
        'section_label',
        'section_title',
        'cta_label',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'form_title',
        'form_description',
        'form_name_placeholder',
        'form_email_placeholder',
        'form_message_placeholder',
        'form_privacy_text',
        'form_button_text',
    ];
}

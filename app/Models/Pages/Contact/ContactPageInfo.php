<?php

namespace App\Models\Pages\Contact;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactPageInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'subtitle', 'description',
        'form_title', 'form_description',
        'phone_1', 'phone_2', 'email_1', 'email_2',
        'address_line_1', 'address_line_2', 'map_embed_url',
        'breadcrumb_home', 'breadcrumb_current',
        'form_name_placeholder', 'form_email_placeholder', 'form_message_placeholder',
        'form_privacy_text', 'form_button_text',
        'contact_form_image', 'form_action_url',
        'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
        'cta_button_url', 'cta_image',
        'phones', 'emails', 'addresses',
        'field_styles', 'default_styles',
    ];

    protected $casts = [
        'phones' => 'array',
        'emails' => 'array',
        'addresses' => 'array',
        'field_styles' => 'array',
        'default_styles' => 'array',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'description',
        'form_title',
        'form_description',
        'form_name_placeholder',
        'form_email_placeholder',
        'form_message_placeholder',
        'form_privacy_text',
        'form_button_text',
        'cta_label',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'breadcrumb_home',
        'breadcrumb_current',
    ];
}

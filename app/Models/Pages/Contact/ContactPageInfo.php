<?php

namespace App\Models\Pages\Contact;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

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

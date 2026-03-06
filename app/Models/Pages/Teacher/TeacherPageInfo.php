<?php

namespace App\Models\Pages\Teacher;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeacherPageInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'subtitle',
        'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
        'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
        'cta_button_url', 'cta_image',
        'field_styles', 'default_styles',
    ];

    protected $casts = [
        'field_styles' => 'array',
        'default_styles' => 'array',
    ];

    public $translatable = [
        'title', 'subtitle',
        'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
        'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
    ];
}

<?php

namespace App\Models\Pages\Teacher;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeacherPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'title', 'subtitle',
        'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
        'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
    ];
}

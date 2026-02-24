<?php

namespace App\Models\Pages\Course;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CoursePageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'title', 'breadcrumb_home', 'breadcrumb_current', 'detail_breadcrumb_current',
        'search_placeholder', 'search_button_text', 'result_text',
        'detail_what_learn_title', 'detail_why_choose_title',
        'sidebar_info_title',
        'sidebar_price_label', 'sidebar_instructor_label',
        'sidebar_certification_label', 'sidebar_lessons_label',
        'sidebar_duration_label', 'sidebar_language_label', 'sidebar_students_label',
        'sidebar_contact_title',
        'sidebar_contact_phone_label', 'sidebar_contact_phone',
        'sidebar_contact_email_label', 'sidebar_contact_email',
        'sidebar_contact_address_label', 'sidebar_contact_address',
        'cta_label', 'cta_title', 'cta_description', 'cta_button_text',
    ];
}

<?php

namespace App\Models\Pages\Services;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ServicesPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'title',
        'subtitle',
        'description',
        'info_title',
        'info_subtitle',
        'info_description',
        'info_skil_column_1',
        'info_skil_column_2',
        'info_skil_column_3',
        'faq_title'
    ];

    protected $casts = [
        'faq_ids' => 'array',
    ];
}

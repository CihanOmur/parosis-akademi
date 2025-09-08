<?php

namespace App\Models\Pages\AboutUs;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutUsPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'title',
        'subtitle',
        'description',
        'mision_title',
        'mision_description_1',
        'mision_description_2',
        'gallery_title',
        'gallery_subtitle',
        'references_title',
        'references_subtitle',
    ];

    protected $casts = [
        'references_ids' => 'array',
    ];
}

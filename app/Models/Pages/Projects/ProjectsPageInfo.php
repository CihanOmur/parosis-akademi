<?php

namespace App\Models\Pages\Projects;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProjectsPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'title',
        'subtitle',
        'description',
        'references_title'
    ];

    protected $casts = [
        'references_ids' => 'array',
    ];
}

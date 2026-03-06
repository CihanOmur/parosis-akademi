<?php

namespace App\Models\Pages\Projects;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProjectsPageInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'subtitle', 'description', 'references_title', 'references_ids',
    ];

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

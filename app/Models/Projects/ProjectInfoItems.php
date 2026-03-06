<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProjectInfoItems extends Model
{
    use HasTranslations;
    protected $fillable = [
        'project_id', 'title', 'content', 'order',
    ];
    public $translatable = ['title', 'content'];
}

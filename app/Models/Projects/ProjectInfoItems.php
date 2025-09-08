<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProjectInfoItems extends Model
{
    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['title', 'content'];
}

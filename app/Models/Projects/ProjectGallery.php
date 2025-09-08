<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProjectGallery extends Model
{
    use HasTranslations;
    public $translatable = ['title'];
}

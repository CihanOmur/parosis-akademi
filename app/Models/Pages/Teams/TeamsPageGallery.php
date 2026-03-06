<?php

namespace App\Models\Pages\Teams;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeamsPageGallery extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'image',
    ];

    public $translatable = ['title'];
}



<?php

namespace App\Models\Pages\Teams;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeamsPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['title', 'subtitle', 'description', 'gallery_title', 'gallery_subtitle', 'comment_title'];

    protected $casts = [
        'comments_ids' => 'array',
    ];
}

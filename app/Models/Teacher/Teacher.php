<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name', 'title', 'short_description', 'bio',
        'image', 'phone', 'email',
        'facebook_url', 'twitter_url', 'dribbble_url', 'instagram_url',
        'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $translatable = [
        'name', 'title', 'short_description', 'bio',
    ];
}

<?php

namespace App\Models\Pages\Privacy;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PrivacyPageInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'breadcrumb_home', 'breadcrumb_current', 'content',
    ];

    public $translatable = [
        'title',
        'breadcrumb_home',
        'breadcrumb_current',
        'content',
    ];
}

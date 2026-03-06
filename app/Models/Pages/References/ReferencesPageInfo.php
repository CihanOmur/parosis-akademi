<?php

namespace App\Models\Pages\References;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ReferencesPageInfo extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'subtitle', 'description',
        'contact_title', 'contact_button_title', 'contact_button_link',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'description',
        'contact_title',
        'contact_button_title',
        'contact_button_link',
    ];

}

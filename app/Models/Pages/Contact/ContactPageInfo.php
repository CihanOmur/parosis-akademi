<?php

namespace App\Models\Pages\Contact;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactPageInfo extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'title',
        'subtitle',
        'description',
        'form_title',
        'form_description'
    ];
}

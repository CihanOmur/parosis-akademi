<?php

namespace App\Models\Languages;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Languages extends Model
{
    use HasTranslations;

    protected $fillable = ['sort_order'];

    public $translatable = [
        'name'
    ];
}

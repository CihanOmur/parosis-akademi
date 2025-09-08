<?php

namespace App\Models\Service;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Services extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['title', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

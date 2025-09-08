<?php

namespace App\Models\Faq;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations;
    protected $fillable = [
        'question',
        'answer',
        'category_id',
    ];

    public $translatable = [
        'question',
        'answer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->where('model', 'Faq');
    }
}

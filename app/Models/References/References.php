<?php

namespace App\Models\References;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;;

class References extends Model
{
    use HasTranslations;
    public $translatable = ['name'];


    /**
     * Get the category associated with the References
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}

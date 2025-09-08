<?php

namespace App\Models\Blogs;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['title', 'description'];

    /**
     * Get all of the categories for the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(Category::class, BlogCategories::class, 'blog_id', 'id', 'id', 'category_id');
    }
}

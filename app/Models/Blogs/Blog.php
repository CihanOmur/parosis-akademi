<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'content', 'short_description',
        'image', 'published_at', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public $translatable = ['title', 'content', 'short_description'];

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_blog_category');
    }

    public function blogTags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_blog_tag');
    }
}

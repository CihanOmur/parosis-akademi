<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BlogCategory extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'description', 'image', 'is_active', 'sort_order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $translatable = ['name', 'description'];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_blog_category');
    }
}

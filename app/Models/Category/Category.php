<?php

namespace App\Models\Category;

use App\Models\Blogs\Blog;
use App\Models\Blogs\BlogCategories;
use App\Models\Projects\Projects;
use App\Models\References\References;
use App\Models\Service\Services;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'model',
        'is_active',
    ];

    public function references()
    {
        return $this->hasMany(References::class, 'category_id')->where('model', 'References');
    }

    public function departments()
    {
        return $this->hasMany(References::class, 'category_id')->where('model', 'Departments');
    }

    public function services()
    {
        return $this->hasMany(Services::class, 'category_id')->where('model', 'Services');
    }
    public function blogs()
    {
        return $this->hasManyThrough(Blog::class, BlogCategories::class, 'category_id', 'id', 'id', 'blog_id')
            ->where('model', 'Blogs');
    }

    public function projects()
    {
        return $this->hasMany(Projects::class, 'category_id')->where('model', 'Projects');
    }
    public function faqs()
    {
        return $this->hasMany(Projects::class, 'category_id')->where('model', 'Faq');
    }
}

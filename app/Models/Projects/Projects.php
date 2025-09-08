<?php

namespace App\Models\Projects;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Projects extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'short_content', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function infoItems()
    {
        return $this->hasMany(ProjectInfoItems::class, 'project_id');
    }
    public function gallery()
    {
        return $this->hasMany(ProjectGallery::class, 'project_id');
    }
}

<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CourseCategory extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'icon', 'color', 'is_active', 'sort_order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $translatable = ['name'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_course_category');
    }
}

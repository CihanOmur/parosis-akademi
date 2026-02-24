<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title', 'short_description', 'content',
        'what_you_learn', 'why_choose',
        'image', 'inner_image',
        'price', 'duration', 'lesson_count', 'language',
        'student_count', 'has_certification',
        'instructor_name', 'instructor_image',
        'published_at', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'has_certification' => 'boolean',
        'published_at' => 'datetime',
    ];

    public $translatable = ['title', 'short_description', 'content', 'what_you_learn', 'why_choose'];

    public function categories()
    {
        return $this->belongsToMany(CourseCategory::class, 'course_course_category');
    }
}

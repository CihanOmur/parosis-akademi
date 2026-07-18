<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseApplication extends Model
{
    protected $fillable = [
        'course_id', 'student_name', 'student_age', 'school', 'grade',
        'parent_name', 'phone', 'email', 'status', 'note', 'contacted_at',
    ];

    protected $casts = [
        'contacted_at' => 'datetime',
        'student_age' => 'integer',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}

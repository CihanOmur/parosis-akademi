<?php

namespace App\Models\Class;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LessonClass extends Model
{
    protected $fillable = [
        'name',
        'day',
        'time',
        'price',
        'quota',
        'teacher_name',
        'start_date',
        'end_date',
        'course_time',
    ];

    /**
     * Get the teacher associated with the LessonClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }
}

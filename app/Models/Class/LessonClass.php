<?php

namespace App\Models\Class;

use Illuminate\Database\Eloquent\Model;

class LessonClass extends Model
{
    protected $fillable = [
        'name',
        'day',
        'time',
        'price',
        'quota',
        'teacher_name'
    ];
}

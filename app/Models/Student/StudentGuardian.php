<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class StudentGuardian extends Model
{
    protected $fillable = [
        'student_id',
        'full_name',
        'national_id',
        'relationship',
        'birth_date',
        'education_level',
        'job',
        'phone_1',
        'phone_2',
        'email',
        'home_address',
        'work_address',
        'active'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

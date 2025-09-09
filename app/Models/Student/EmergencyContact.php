<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    protected $fillable = [
        'student_id',
        'full_name',
        'relationship',
        'phone',
        'address'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

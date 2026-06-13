<?php

namespace App\Models\Student;

use App\Models\Certificate;
use App\Models\Class\LessonClass;
use App\Models\Student\StudentPayments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'registration_type',
        'full_name',
        'gender',
        'birth_date',
        'school_name',
        'national_id',
        'blood_type',
        'notes',
        'class_id',
        'has_allergy',
        'allergy_detail'
    ];

    public function guardians()
    {
        return $this->hasMany(StudentGuardian::class);
    }

    public function emergencyContact()
    {
        return $this->hasOne(EmergencyContact::class);
    }

    public function lessonClass()
    {
        return $this->belongsTo(LessonClass::class, 'class_id');
    }

    public function payments()
    {
        return $this->hasMany(StudentPayments::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class)->orderByDesc('issue_date');
    }
}

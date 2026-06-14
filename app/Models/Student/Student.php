<?php

namespace App\Models\Student;

use App\Models\Certificate;
use App\Models\Class\LessonClass;
use App\Models\Competition;
use App\Models\CompetitionStudent;
use App\Models\Student\StudentPayments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function competitions(): BelongsToMany
    {
        return $this->belongsToMany(Competition::class, 'competition_student')
            ->using(CompetitionStudent::class)
            ->withPivot([
                'id',
                'parent_consent_status',
                'passport_status',
                'visa_status',
                'payment_status',
                'payment_amount',
                'payment_currency',
                'result_rank',
                'result_label',
                'result_notes',
                'joined_at',
            ])
            ->withTimestamps()
            ->orderByDesc('competitions.start_date');
    }

    public function competitionEntries(): HasMany
    {
        return $this->hasMany(CompetitionStudent::class);
    }
}

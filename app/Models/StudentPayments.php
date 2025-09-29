<?php

namespace App\Models;

use App\Models\Class\LessonClass;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentPayments extends Model
{
    protected $guarded = [];
    /**
     * Get all of the installments for the StudentPayments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function installments(): HasMany
    {
        return $this->hasMany(StudentPaymentsInstallment::class, 'student_payment_id', 'id');
    }

    /**
     * Get the class that owns the StudentPayments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(LessonClass::class, 'class_id', 'id');
    }

    /**
     * Get the student that owns the StudentPayments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}

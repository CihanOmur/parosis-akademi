<?php

namespace App\Models;

use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competition extends Model
{
    protected $fillable = [
        'name',
        'organizer',
        'location',
        'start_date',
        'end_date',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'competition_student')
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
            ->withTimestamps();
    }

    public function entries(): HasMany
    {
        return $this->hasMany(CompetitionStudent::class);
    }
}

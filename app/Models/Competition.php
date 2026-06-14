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
        'country',
        'city',
        'start_date',
        'end_date',
        'internal_deadline',
        'description',
        'website_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'         => 'boolean',
        'start_date'        => 'date',
        'end_date'          => 'date',
        'internal_deadline' => 'date',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CompetitionCategory::class, 'competition_competition_category')
            ->orderBy('name');
    }

    public function getDateRangeAttribute(): ?string
    {
        if ($this->start_date && $this->end_date) {
            if ($this->start_date->equalTo($this->end_date)) {
                return $this->start_date->format('d.m.Y');
            }
            return $this->start_date->format('d.m.Y') . ' → ' . $this->end_date->format('d.m.Y');
        }
        return $this->start_date?->format('d.m.Y');
    }

    public function getCountryCityAttribute(): ?string
    {
        return trim(implode(' / ', array_filter([$this->city, $this->country])), ' /') ?: $this->location;
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'competition_student')
            ->using(CompetitionStudent::class)
            ->withPivot([
                'id',
                'competition_category_id',
                'team_name',
                'parent_consent_status',
                'passport_status',
                'passport_valid_6m',
                'visa_status',
                'payment_status',
                'payment_amount',
                'payment_currency',
                'result_rank',
                'result_label',
                'result_notes',
                'result_file',
                'joined_at',
            ])
            ->withTimestamps();
    }

    public function entries(): HasMany
    {
        return $this->hasMany(CompetitionStudent::class);
    }
}

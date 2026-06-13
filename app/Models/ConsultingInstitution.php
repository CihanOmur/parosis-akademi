<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsultingInstitution extends Model
{
    protected $fillable = [
        'name',
        'contact_email',
        'contact_phone',
        'notes',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class)->orderByDesc('issue_date');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

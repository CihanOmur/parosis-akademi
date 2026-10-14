<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Site ziyaretçi üyesi (veli / öğrenci / müşteri).
 * Panel kullanıcılarından (App\Models\User\User) ayrıdır; 'member' guard'ı ile giriş yapar.
 */
class Member extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_active',
        'privacy_accepted_at',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'privacy_accepted_at' => 'datetime',
            'last_login_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value === null ? null : mb_strtolower(trim($value)),
        );
    }
}

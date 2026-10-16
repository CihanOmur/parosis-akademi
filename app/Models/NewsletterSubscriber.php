<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * Footer "Haber Al" e-bülten abonesi. Panel → E-bülten Aboneleri.
 */
class NewsletterSubscriber extends Model
{
    protected $fillable = ['email', 'locale', 'ip_address'];

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value === null ? null : mb_strtolower(trim($value)),
        );
    }
}

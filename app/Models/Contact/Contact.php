<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'message',
    ];

    public function addresses()
    {
        return $this->hasMany(ContactAddress::class);
    }

    public function phones()
    {
        return $this->hasMany(ContactPhone::class);
    }

    public function mails()
    {
        return $this->hasMany(ContactMail::class);
    }
}

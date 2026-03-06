<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Model;

class ContactMail extends Model
{
    protected $fillable = [
        'contact_id', 'email',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

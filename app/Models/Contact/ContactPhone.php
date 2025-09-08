<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Model;

class ContactPhone extends Model
{
    protected $guarded = [];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

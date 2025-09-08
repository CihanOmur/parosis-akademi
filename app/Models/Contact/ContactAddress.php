<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactAddress extends Model
{
    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['title', 'address'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

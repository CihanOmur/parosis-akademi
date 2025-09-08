<?php

namespace App\Models\Teams;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeamsUserPersonelInfo extends Model
{
    use HasTranslations;
    protected $table = 'teams_user_personal_infos';
    protected $guarded = [];
    public $translatable = ['title', 'description'];
}

<?php

namespace App\Models\Teams;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class Teams extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'position'];

    /**
     * Get the category associated with the Teams
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get the personal info associated with the Teams
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personalInfos(): HasMany
    {
        return $this->hasMany(TeamsUserPersonelInfo::class, 'team_id', 'id');
    }
}

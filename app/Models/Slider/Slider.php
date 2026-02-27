<?php

namespace App\Models\Slider;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'name',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(SliderItem::class)->orderBy('sort_order');
    }

    public function activeItems()
    {
        return $this->hasMany(SliderItem::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }
}

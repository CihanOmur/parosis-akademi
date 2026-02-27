<?php

namespace App\Models\Slider;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SliderItem extends Model
{
    use HasTranslations;

    protected $fillable = [
        'slider_id',
        'title',
        'highlight_text',
        'description',
        'button_text',
        'button_url',
        'image',
        'background_image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $translatable = [
        'title',
        'highlight_text',
        'description',
        'button_text',
    ];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}

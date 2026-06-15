<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasTranslations;

    protected $fillable = [
        'parent_id',
        'label',
        'url',
        'target',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $translatable = [
        'label',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    /**
     * URL'i mevcut locale ile prefixle.
     * - "#" veya boş → değişmez (placeholder)
     * - "http(s)://" veya "//" → dış link, değişmez
     * - "/foo" → "/tr/foo"
     */
    public function getLocalizedUrlAttribute(): string
    {
        $url = (string) $this->url;

        if ($url === '' || $url === '#') {
            return $url;
        }
        if (preg_match('#^(https?:)?//#', $url)) {
            return $url;
        }

        $locale = app()->getLocale() ?: config('app.locale', 'tr');
        $path = '/' . ltrim($url, '/');

        // Anasayfa kısa yolu: '/' → '/tr'
        if ($path === '/') {
            return '/' . $locale;
        }

        return '/' . $locale . $path;
    }
}

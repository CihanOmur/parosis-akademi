<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SitemapEntry extends Model
{
    protected $fillable = [
        'loc',
        'changefreq',
        'priority',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

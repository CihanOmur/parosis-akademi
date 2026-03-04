<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name', 'short_description', 'description', 'features',
        'sku', 'image', 'price', 'sale_price',
        'stock', 'manage_stock', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'manage_stock' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public $translatable = ['name', 'short_description', 'description', 'features'];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_product_category');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class)->orderBy('sort_order');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function getEffectivePriceAttribute(): float
    {
        return $this->sale_price ?? $this->price;
    }

    public function hasVariants(): bool
    {
        return $this->variants()->where('is_active', true)->exists();
    }
}

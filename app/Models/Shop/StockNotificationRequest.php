<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockNotificationRequest extends Model
{
    protected $fillable = ['product_id', 'email', 'note', 'notified_at'];
    protected $casts = ['notified_at' => 'datetime'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

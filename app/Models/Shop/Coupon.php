<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value',
        'min_order_amount', 'max_discount_amount',
        'usage_limit', 'used_count',
        'starts_at', 'expires_at',
        'is_active',
    ];

    protected $casts = [
        'value'              => 'decimal:2',
        'min_order_amount'   => 'decimal:2',
        'max_discount_amount'=> 'decimal:2',
        'starts_at'          => 'date',
        'expires_at'         => 'date',
        'is_active'          => 'boolean',
    ];

    public function isValid(float $subtotal): bool
    {
        if (! $this->is_active) return false;
        if ($this->starts_at && $this->starts_at->gt(today())) return false;
        if ($this->expires_at && $this->expires_at->lt(today())) return false;
        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) return false;
        if ($subtotal < (float) $this->min_order_amount) return false;

        return true;
    }

    public function validationMessage(float $subtotal): ?string
    {
        if (! $this->is_active) return 'Bu kupon aktif değil.';
        if ($this->starts_at && $this->starts_at->gt(today())) return 'Bu kupon henüz başlamamış. Başlangıç: ' . $this->starts_at->format('d.m.Y');
        if ($this->expires_at && $this->expires_at->lt(today())) return 'Bu kuponun süresi dolmuş.';
        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) return 'Bu kuponun kullanım limiti dolmuş.';
        if ($subtotal < (float) $this->min_order_amount) return 'Minimum sipariş tutarı: ' . number_format($this->min_order_amount, 2, ',', '.') . ' ₺';

        return null;
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === 'percentage') {
            $discount = $subtotal * (float) $this->value / 100;
            if ($this->max_discount_amount !== null) {
                $discount = min($discount, (float) $this->max_discount_amount);
            }
            return round($discount, 2);
        }

        // fixed
        return round(min((float) $this->value, $subtotal), 2);
    }

    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }
}

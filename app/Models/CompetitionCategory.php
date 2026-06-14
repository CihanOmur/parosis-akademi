<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CompetitionCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    protected static function booted(): void
    {
        static::saving(function (CompetitionCategory $cat) {
            if (empty($cat->slug)) {
                $base = Str::slug($cat->name);
                $slug = $base;
                $i = 2;
                while (self::where('slug', $slug)->where('id', '!=', $cat->id ?? 0)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $cat->slug = $slug;
            }
        });
    }

    public function competitions(): BelongsToMany
    {
        return $this->belongsToMany(Competition::class, 'competition_competition_category');
    }

    public function studentEntries(): HasMany
    {
        return $this->hasMany(CompetitionStudent::class, 'competition_category_id');
    }

    /**
     * "Mini Sumo, Çizgi İzleyen, ABC" gibi bir input'tan kategorileri bulup/oluştur, id'leri döner.
     * Hem id (int) hem yeni etiket (string) destekler — Select2 tagging pattern.
     */
    public static function syncFromInput(array $items): array
    {
        $ids = [];
        foreach ($items as $value) {
            $value = trim((string) $value);
            if ($value === '') continue;

            if (ctype_digit($value)) {
                if (self::where('id', $value)->exists()) {
                    $ids[] = (int) $value;
                    continue;
                }
            }

            $cat = self::firstOrCreate(['name' => $value]);
            $ids[] = $cat->id;
        }
        return array_values(array_unique($ids));
    }
}

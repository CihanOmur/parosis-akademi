<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['group', 'key', 'value'];

    public static function get(string $key, mixed $default = null, string $group = 'general'): mixed
    {
        $cacheKey = "setting.{$group}.{$key}";

        return Cache::remember($cacheKey, 86400, function () use ($group, $key, $default) {
            $setting = static::where('group', $group)->where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function set(string $key, mixed $value, string $group = 'general'): void
    {
        static::updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['value' => $value]
        );
        Cache::forget("setting.{$group}.{$key}");
        Cache::forget("settings.group.{$group}");
    }

    public static function getGroup(string $group): array
    {
        return Cache::remember("settings.group.{$group}", 86400, function () use ($group) {
            return static::where('group', $group)
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    public static function saveGroup(string $group, array $data): void
    {
        foreach ($data as $key => $value) {
            static::updateOrCreate(
                ['group' => $group, 'key' => $key],
                ['value' => $value]
            );
            Cache::forget("setting.{$group}.{$key}");
        }
        Cache::forget("settings.group.{$group}");
    }
}

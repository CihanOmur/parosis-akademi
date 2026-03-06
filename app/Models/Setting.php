<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    protected $fillable = ['group', 'key', 'value'];

    /**
     * Şifrelenmiş olarak saklanacak ayar anahtarları (group.key formatında).
     */
    protected static array $encryptedKeys = [
        'mail.mail_password',
    ];

    protected static function isEncrypted(string $group, string $key): bool
    {
        return in_array("{$group}.{$key}", static::$encryptedKeys);
    }

    protected static function encryptValue(string $group, string $key, mixed $value): mixed
    {
        if (static::isEncrypted($group, $key) && $value !== null && $value !== '') {
            return Crypt::encryptString((string) $value);
        }
        return $value;
    }

    protected static function decryptValue(string $group, string $key, mixed $value): mixed
    {
        if (static::isEncrypted($group, $key) && $value !== null && $value !== '') {
            try {
                return Crypt::decryptString($value);
            } catch (\Exception $e) {
                // Henüz şifrelenmemiş eski düz metin değer
                return $value;
            }
        }
        return $value;
    }

    public static function get(string $key, mixed $default = null, string $group = 'general'): mixed
    {
        $cacheKey = "setting.{$group}.{$key}";

        return Cache::remember($cacheKey, 86400, function () use ($group, $key, $default) {
            $setting = static::where('group', $group)->where('key', $key)->first();
            if (!$setting) {
                return $default;
            }
            return static::decryptValue($group, $key, $setting->value);
        });
    }

    public static function set(string $key, mixed $value, string $group = 'general'): void
    {
        $storedValue = static::encryptValue($group, $key, $value);

        static::updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['value' => $storedValue]
        );
        Cache::forget("setting.{$group}.{$key}");
        Cache::forget("settings.group.{$group}");
    }

    public static function getGroup(string $group): array
    {
        return Cache::remember("settings.group.{$group}", 86400, function () use ($group) {
            $settings = static::where('group', $group)
                ->pluck('value', 'key')
                ->toArray();

            foreach ($settings as $key => &$value) {
                $value = static::decryptValue($group, $key, $value);
            }

            return $settings;
        });
    }

    public static function saveGroup(string $group, array $data): void
    {
        foreach ($data as $key => $value) {
            $storedValue = static::encryptValue($group, $key, $value);

            static::updateOrCreate(
                ['group' => $group, 'key' => $key],
                ['value' => $storedValue]
            );
            Cache::forget("setting.{$group}.{$key}");
        }
        Cache::forget("settings.group.{$group}");
    }
}

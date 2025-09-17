<?php

namespace App\Providers;

use Illuminate\Support\Str;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Str::macro('upperTr', function ($value) {
            $map = [
                'i' => 'İ',
                'ı' => 'I',
                'ğ' => 'Ğ',
                'ü' => 'Ü',
                'ş' => 'Ş',
                'ö' => 'Ö',
                'ç' => 'Ç',
                'İ' => 'İ',
                'I' => 'I',
                'Ğ' => 'Ğ',
                'Ü' => 'Ü',
                'Ş' => 'Ş',
                'Ö' => 'Ö',
                'Ç' => 'Ç',
            ];

            // önce özel Türkçe harfleri değiştir
            $value = str_replace(array_keys($map), array_values($map), $value);

            // sonra normal strtoupper uygula
            return strtoupper($value);
        });
    }
}

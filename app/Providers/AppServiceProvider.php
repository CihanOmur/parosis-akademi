<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        Paginator::useBootstrapFive();
        Paginator::defaultView('vendor.pagination.tailwind');
        Paginator::defaultSimpleView('vendor.pagination.simple-tailwind');

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

        $this->overrideMailConfig();
        $this->overrideValidationMessages();
        $this->setDefaultRouteLocale();
    }

    /**
     * route('front.X') çağrılarının {locale} parametresi olmadan da çalışmasını
     * sağlar. Admin panelinden / mail'lerden / artisan'dan üretilen URL'lerde
     * default locale (config('app.locale')) otomatik kullanılır.
     * SetLocale middleware front grubunda bunu URL'deki locale ile override eder.
     */
    private function setDefaultRouteLocale(): void
    {
        URL::defaults(['locale' => config('app.locale', 'tr')]);
    }

    private function overrideValidationMessages(): void
    {
        try {
            if (!Schema::hasTable('settings')) {
                return;
            }

            $locale = config('app.locale', 'tr');
            $translator = app('translator');

            // DB'deki mesaj override'larını yükle
            $savedMessages = Setting::getGroup('validation_messages');
            if (!empty($savedMessages)) {
                foreach ($savedMessages as $key => $value) {
                    // "between.numeric" gibi noktalı anahtarları nested hale getir
                    $translator->addLines(["validation.{$key}" => $value], $locale);
                }
            }

            // DB'deki attribute override'larını yükle
            $savedAttributes = Setting::getGroup('validation_attributes');
            if (!empty($savedAttributes)) {
                foreach ($savedAttributes as $key => $value) {
                    $translator->addLines(["validation.attributes.{$key}" => $value], $locale);
                }
            }
        } catch (\Exception $e) {
            //
        }
    }

    private function overrideMailConfig(): void
    {
        try {
            if (!Schema::hasTable('settings')) {
                return;
            }

            $m = Setting::getGroup('mail');
            if (empty($m)) {
                return;
            }

            if (!empty($m['mail_mailer']))       config(['mail.default' => $m['mail_mailer']]);
            if (!empty($m['mail_host']))          config(['mail.mailers.smtp.host' => $m['mail_host']]);
            if (!empty($m['mail_port']))          config(['mail.mailers.smtp.port' => (int) $m['mail_port']]);
            if (!empty($m['mail_username']))      config(['mail.mailers.smtp.username' => $m['mail_username']]);
            if (!empty($m['mail_password']))      config(['mail.mailers.smtp.password' => $m['mail_password']]);
            if (isset($m['mail_encryption']))     config(['mail.mailers.smtp.encryption' => $m['mail_encryption'] ?: null]);
            if (!empty($m['mail_from_address']))  config(['mail.from.address' => $m['mail_from_address']]);
            if (!empty($m['mail_from_name']))     config(['mail.from.name' => $m['mail_from_name']]);
        } catch (\Exception $e) {
            //
        }
    }
}

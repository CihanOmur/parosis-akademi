<?php

namespace App\Http\Middleware;

use App\Models\Languages\Languages;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * URL'deki {locale} segmentini doğrula, app locale'i ayarla ve cookie'ye yaz.
     * Geçersiz locale → 404. Locale yoksa default'a redirect (üst seviyede ele alınır).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        $valid = Languages::where('locale', $locale)
            ->where('status', 1)
            ->where('is_active', 1)
            ->exists();

        if (!$valid) {
            abort(404);
        }

        app()->setLocale($locale);
        URL::defaults(['locale' => $locale]);

        $response = $next($request);

        Cookie::queue(Cookie::make('app_locale', $locale, 60 * 24 * 365));

        return $response;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Panelden pasifleştirilen üyenin açık oturumunu ilk istekte kapatır.
 * (SessionGuard oturumdaki üyeyi yalnız id ile yükler, is_active'e bakmaz.)
 */
class EnsureMemberIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('member');

        if ($guard->check() && !$guard->user()->is_active) {
            $guard->logout();
            $request->session()->regenerateToken();

            // auth:member bu katmandan önce çalışmış olabilir (middleware önceliği) → üye sayfasını açma
            if ($request->routeIs('front.account*')) {
                return redirect()->route('front.member.login', ['locale' => $request->route('locale') ?: app()->getLocale()]);
            }
        }

        return $next($request);
    }
}

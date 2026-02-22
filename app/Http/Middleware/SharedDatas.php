<?php

namespace App\Http\Middleware;

use App\Models\Languages\Languages;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SharedDatas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $activeLanguages = Languages::where('status', 1)->where('is_active', 1)->select('id', 'locale', 'name', 'is_default')->get();
        $defaultLanguage = $activeLanguages->firstWhere('is_default', 1)
            ?? Languages::where('status', 1)->where('is_default', 1)->select('id', 'locale', 'name', 'is_default')->first();
        view()->share([
            'activeLanguages' => $activeLanguages,
            'defaultLanguage' => $defaultLanguage,
        ]);
        return $next($request);
    }
}

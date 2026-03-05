<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (Schema::hasTable('settings') && Setting::get('maintenance_mode', '0', 'advanced') === '1') {
                return response()->view('front.maintenance', [], 503);
            }
        } catch (\Exception $e) {
            //
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DriverAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('driver_id')) {
            return redirect()->route('driver.login');
        }
        return $next($request);
    }
}
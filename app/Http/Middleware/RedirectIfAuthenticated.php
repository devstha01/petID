<?php

namespace App\Http\Middleware;

use App\Cloudsa9\Constants\Config;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/' . Config::SUBSCRIBER_DASHBOARD_ROUTE_PREFIX);
        }

        return $next($request);
    }
}

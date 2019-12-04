<?php

namespace App\Http\Middleware;

use Closure;

class SecureRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->environment('production')) {
            if (substr($request->header('Host'), 0, 4)  !== 'www.') {
                $request->headers->set('Host', 'www.fowndapp.com');

                return redirect()->secure($request->path(), 301);
            }

            if (! $request->secure()) {
                return redirect()->secure($request->path(), 301);
            }
        }

        return $next($request);
    }
}

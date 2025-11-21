<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ForceAppUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Forzar la URL de la aplicación desde el .env
        if ($appUrl = config('app.url')) {
            URL::forceRootUrl($appUrl);
            
            // Si la URL usa HTTPS, forzar esquema HTTPS
            if (str_starts_with($appUrl, 'https://')) {
                URL::forceScheme('https');
            }
        }

        return $next($request);
    }
}

<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Confiar en todos los proxies (necesario para Railway, Heroku, etc.)
        $middleware->trustProxies(at: '*');
        
        // Forzar URL desde .env para túneles y proxies
        $middleware->prepend(\App\Http\Middleware\ForceAppUrl::class);
        
        // Registrar alias de middleware personalizado
        $middleware->alias([
            'simple.auth' => \App\Http\Middleware\SimpleAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

<?php

namespace App\Providers;

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
        // Forzar HTTPS solo si la petición viene del túnel
        if ($this->app->environment('local')) {
            $host = request()->getHost();
            if (str_contains($host, 'devtunnels.ms')) {
                \Illuminate\Support\Facades\URL::forceScheme('https');
            }
        }
    }
}

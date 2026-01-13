<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- 1. TAMBAHAN DI SINI

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
        // 2. TAMBAHAN DI SINI (LOGIC FORCE HTTPS)
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}

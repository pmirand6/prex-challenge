<?php

namespace App\Providers;

use App\Http\Middleware\AuditMiddleware;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the AuditMiddleware as a singleton for use the same instance across the application
        $this->app->singleton(AuditMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

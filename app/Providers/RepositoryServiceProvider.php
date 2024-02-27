<?php

namespace App\Providers;

use App\Repositories\AuditTrailRepository;
use App\Repositories\Contracts\IAuditTrailRepository;
use App\Repositories\Contracts\IUserGifRepository;
use App\Repositories\UserGifRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IUserGifRepository::class,
            UserGifRepository::class
        );
        $this->app->bind(
            IAuditTrailRepository::class,
            AuditTrailRepository::class
        );
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

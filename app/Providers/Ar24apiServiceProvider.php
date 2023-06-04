<?php

namespace App\Providers;

use App\Services\Ar24apiClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class Ar24apiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('Ar24api', function(Application $app) {
            return new Ar24apiClient();
        });
    }

    /**
     * Bootstrap service
     */
    public function boot(): void
    {
        //
    }
}

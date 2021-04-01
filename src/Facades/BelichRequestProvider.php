<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Facades;

use Illuminate\Support\ServiceProvider;

final class BelichRequestProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->app->singleton('BelichRequest', static function () {
            return new \Daguilarm\Belich\Core\BelichRequest();
        });
    }
}

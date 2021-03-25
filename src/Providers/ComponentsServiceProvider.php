<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Providers;

use BladeUI\Icons\Factory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as Provider;

final class ComponentsServiceProvider extends Provider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        //Load all the blade components
        Blade::component('belich::app', 'app');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        //
    }
}

<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Providers;

use Daguilarm\Belich\App\View\Components\Group;
use Daguilarm\Belich\App\View\Components\Sidebar;
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
        // Load the custom sidebar components
        Blade::component('belich::sidebar-group', Group::class);
        Blade::component('belich::sidebar', Sidebar::class);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
    }
}

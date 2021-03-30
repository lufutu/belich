<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Providers;

use Daguilarm\Belich\App\View\Components\Container;
use Daguilarm\Belich\App\View\Components\Group;
use Daguilarm\Belich\App\View\Components\Navbar;
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
        // Load the custom sidebar components
        Blade::component('belich-sidebar', Sidebar::class);
        Blade::component('belich::sidebar.group', Group::class);

        // Load the custom navbar components
        Blade::component('belich-navbar', Navbar::class);

        // Load the custom main container components
        Blade::component('belich-container', Container::class);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
    }
}

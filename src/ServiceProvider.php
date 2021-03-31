<?php

declare(strict_types=1);

namespace Daguilarm\Belich;

use Daguilarm\Belich\App\Http\Livewire\UpdateProfileInformationForm;
use Daguilarm\Belich\App\View\Components\Group;
use Daguilarm\Belich\App\View\Components\Sidebar;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as Provider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

final class ServiceProvider extends Provider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerBootstrap();
        $this->registerRoutes();
        $this->registerResources();
        $this->configureComponents();
        $this->configureLivewire();
        // $this->registerConsole();
        // $this->registerMigrations();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        //Belich Facade
        $this->app->register(\Daguilarm\Belich\Facades\BelichProvider::class);
        AliasLoader::getInstance()->alias('Belich', \Daguilarm\Belich\Facades\Belich::class);

        // //Helper Facade
        $this->app->register(\Daguilarm\Belich\Facades\HelperProvider::class);
        AliasLoader::getInstance()->alias('Helper', \Daguilarm\Belich\Facades\Helper::class);
    }

    /**
     * Register the package bootstrap
     */
    protected function registerBootstrap(): void
    {
        // Middleware
        $this->app['router']->pushMiddlewareToGroup('https', \Daguilarm\Belich\App\Http\Middleware\HttpsMiddleware::class);
        $this->app['router']->pushMiddlewareToGroup('belich', \Daguilarm\Belich\App\Http\Middleware\BelichMiddleware::class);
        $this->app['router']->pushMiddlewareToGroup('minify', \Daguilarm\Belich\App\Http\Middleware\MinifyMiddleware::class);
    }

    /**
     * Register the package routes
     */
    protected function registerRoutes(): void
    {
        // Dashboard routes
        require_once __DIR__ . '/../routes/ResolveRoutes.php';
    }

    /**
     * Configure the Jetstream Blade components.
     */
    protected function configureComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (): void {
            // Load the custom components with classes
            Blade::component('belich-sidebar', Sidebar::class);
            Blade::component('belich-sidebar-group', Group::class);

            // Load anonymous components
            Blade::component('belich::components.app', 'belich-app');
            Blade::component('belich::components.navbar', 'belich-navbar');
            Blade::component('belich::components.sidebar.group-link', 'belich-sidebar-group-link');
            Blade::component('belich::components.sidebar.home', 'belich-sidebar-home');
            Blade::component('belich::components.sidebar.link', 'belich-sidebar-link');
        });
    }

    /**
     * Configure the Livewire components.
     */
    protected function configureLivewire(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (): void {
            // Load the custom components with classes
            Livewire::component('profile-update', UpdateProfileInformationForm::class);
        });
    }

    /**
     * Register the package resources
     */
    protected function registerResources(): void
    {
        //Load the views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'belich');

        //Load language translations...
        $this->loadTranslationsFrom(resource_path('lang/vendor/belich'), 'belich');
        $this->loadJsonTranslationsFrom(resource_path('lang/vendor/belich'), 'belich');
    }

    /**
     * Register the package's publishable resources.
     */
    protected function registerPublishing(): void
    {
        //Publish the config file
        $this->publishes([
            __DIR__ . '/../config/belich.php' => config_path('belich.php'),
            // __DIR__ . '/../stubs/validate-form.stub' => config_path('belich/stubs/validate-form.stub'),
        ]);

        //Publish the views
        $this->publishes([
            // __DIR__ . '/../resources/views/actions' => base_path('resources/views/vendor/belich/actions'),
            // __DIR__ . '/../resources/views/auth' => base_path('resources/views/vendor/belich/auth'),
            // __DIR__ . '/../resources/views/cards' => base_path('resources/views/vendor/belich/cards'),
            // __DIR__ . '/../resources/views/pages' => base_path('resources/views/vendor/belich/pages'),
            // __DIR__ . '/../resources/views/partials' => base_path('resources/views/vendor/belich/partials'),
            __DIR__ . '/../resources/views/components' => base_path('resources/views/vendor/belich/components'),
            // __DIR__ . '/../resources/views/dashboard' => base_path('resources/views/vendor/belich/dashboard'),
        ]);

        //Publish the localization files
        $this->publishes([
            __DIR__ . '/../resources/lang' => base_path('resources/lang/vendor/belich'),
        ]);

        //Publish the public folder
        $this->publishes([
            __DIR__ . '/../public/' => public_path('vendor/belich'),
        ]);

        //Publish the belich directory and the dashboard constructor
        $this->publishes([
            //Set the resources
            __DIR__ . '/../stubs/routes.stub' => base_path('app/Belich/Routes.php'),
        ]);

        // //Publish the belich default resource: User
        // $this->publishes([
        //     //Set the resources
        //     __DIR__ . '/../stubs/defaults/user_resource.stub' => base_path('app/Belich/Resources/User.php'),
        //     __DIR__ . '/../stubs/defaults/profile_resource.stub' => base_path('app/Belich/Resources/Profile.php'),
        // ]);

        // //Publish the belich default policy: User
        // $this->publishes([
        //     //Set the resources
        //     __DIR__ . '/../stubs/defaults/user_policy.stub' => base_path('app/Policies/UserPolicy.php'),
        // ]);

        // //Publish the belich dashboard
        // $this->publishes([
        //     //Set the resources
        //     __DIR__ . '/../stubs/dashboard.stub' => base_path('app/Belich/Dashboard.php'),
        // ]);
    }

    // /**
    //  * Register the package console commands
    //  */
    // protected function registerConsole(): void
    // {
    //     if ($this->app->runningInConsole()) {
    //         $this->commands([
    //             \Daguilarm\Belich\Console\Commands\CardCommand::class,
    //             \Daguilarm\Belich\Console\Commands\ComponentCommand::class,
    //             \Daguilarm\Belich\Console\Commands\MetricCommand::class,
    //             \Daguilarm\Belich\Console\Commands\PolicyCommand::class,
    //             \Daguilarm\Belich\Console\Commands\ResourceCommand::class,
    //         ]);
    //     }
    // }

    /**
     * Register the package migrations
     */
    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}

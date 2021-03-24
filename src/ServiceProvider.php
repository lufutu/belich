<?php

declare(strict_types=1);

namespace Daguilarm\Belich;

use Daguilarm\Belich\App\View\Components\App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as Provider;

final class ServiceProvider extends Provider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        // if ($this->app->runningInConsole()) {
        //     $this->registerPublishing();
        // }

        $this->registerBootstrap();
        $this->registerRoutes();
        $this->registerResources();
        $this->registerComponents();
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

        // //Chart Facade
        // $this->app->register(\Daguilarm\Belich\Facades\ChartProvider::class);
        // AliasLoader::getInstance()->alias('Chart', \Daguilarm\Belich\Facades\Chart::class);

        // //Icon Facade
        // $this->app->register(\Daguilarm\Belich\Facades\IconProvider::class);
        // AliasLoader::getInstance()->alias('Icon', \Daguilarm\Belich\Facades\Icon::class);

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
        $this->app['router']->pushMiddlewareToGroup('https', \Daguilarm\Belich\Http\Middleware\HttpsMiddleware::class);
        // $this->app['router']->pushMiddlewareToGroup('belich', \Daguilarm\Belich\Http\Middleware\BelichMiddleware::class);
        // $this->app['router']->pushMiddlewareToGroup('minify', \Daguilarm\Belich\Http\Middleware\MinifyMiddleware::class);
    }

    /**
     * Register the package routes
     */
    protected function registerRoutes(): void
    {
        //Dashboard routes
        require_once __DIR__ . '/../routes/ResolveRoutes.php';
    }

    /**
     * Register the package resources
     */
    protected function registerResources(): void
    {
        //Load the views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'belich');

        // //Load the blade service provider
        // require_once __DIR__ . '/../src/Providers/BladeProvider.php';

        //Load language translations...
        $this->loadTranslationsFrom(resource_path('lang/vendor/belich'), 'belich');
        $this->loadJsonTranslationsFrom(resource_path('lang/vendor/belich'), 'belich');
    }

    /**
     * Register the package components for blade
     */
    public function registerComponents()
    {
        $this->loadViewComponentsAs('belich', [
            App::class,
        ]);
    }

    // /**
    //  * Register the package's publishable resources.
    //  */
    // protected function registerPublishing(): void
    // {
    //     //Publish the config file
    //     $this->publishes([
    //         __DIR__ . '/../config/belich.php' => config_path('belich.php'),
    //         __DIR__ . '/../stubs/validate-form.stub' => config_path('belich/stubs/validate-form.stub'),
    //     ]);

    //     //Publish the views
    //     $this->publishes([
    //         __DIR__ . '/../resources/views/actions' => base_path('resources/views/vendor/belich/actions'),
    //         __DIR__ . '/../resources/views/auth' => base_path('resources/views/vendor/belich/auth'),
    //         __DIR__ . '/../resources/views/cards' => base_path('resources/views/vendor/belich/cards'),
    //         __DIR__ . '/../resources/views/pages' => base_path('resources/views/vendor/belich/pages'),
    //         __DIR__ . '/../resources/views/partials' => base_path('resources/views/vendor/belich/partials'),
    //         __DIR__ . '/../resources/views/components' => base_path('resources/views/vendor/belich/components'),
    //         __DIR__ . '/../resources/views/dashboard' => base_path('resources/views/vendor/belich/dashboard'),
    //     ]);

    //     //Publish the localization files
    //     $this->publishes([
    //         __DIR__ . '/../resources/lang' => base_path('resources/lang/vendor/belich'),
    //     ]);

    //     //Publish the public folder
    //     $this->publishes([
    //         __DIR__ . '/../public/' => public_path('vendor/belich'),
    //     ]);

    //     //Publish the belich directory and the dashboard constructor
    //     $this->publishes([
    //         //Set the resources
    //         __DIR__ . '/../stubs/routes.stub' => base_path('app/Belich/Routes.php'),
    //     ]);

    //     //Publish the belich default resource: User
    //     $this->publishes([
    //         //Set the resources
    //         __DIR__ . '/../stubs/defaults/user_resource.stub' => base_path('app/Belich/Resources/User.php'),
    //         __DIR__ . '/../stubs/defaults/profile_resource.stub' => base_path('app/Belich/Resources/Profile.php'),
    //     ]);

    //     //Publish the belich default policy: User
    //     $this->publishes([
    //         //Set the resources
    //         __DIR__ . '/../stubs/defaults/user_policy.stub' => base_path('app/Policies/UserPolicy.php'),
    //     ]);

    //     //Publish the belich dashboard
    //     $this->publishes([
    //         //Set the resources
    //         __DIR__ . '/../stubs/dashboard.stub' => base_path('app/Belich/Dashboard.php'),
    //     ]);
    // }

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

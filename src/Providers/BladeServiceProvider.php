<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Providers;

use Daguilarm\Belich\Facades\Belich;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as Provider;
use Illuminate\Support\Str;

final class BladeServiceProvider extends Provider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        /**
         * Create a @icon directive
         *
         * @return string
         */
        Blade::directive('route', static function ($route) {
            return e(route(static::filterArgument($route)));
        });

        /**
         * Create a @mix directive for the package namespace
         *
         * @return string
         */
        Blade::directive('mix', static function ($file) {
            $file = static::filterArgument($file);
            $path = Belich::hasProductionEnvironment()
                ? '/vendor/belich/' . $file . '?v=' . Str::random(20)
                : '/vendor/belich/' . $file;

            if (Str::endsWith($file, ".css'")) {
                return '<link rel="stylesheet" href="' . $path . '" media="all">';
            }
            if (Str::endsWith($file, ".js'")) {
                return '<script src="' . $path . '"></script>';
            }

            return $path;
        });

        /**
         * Create a @trans directive for the package localization's files
         *
         * @return string
         */
        Blade::directive('trans', static function ($text) {
            return e(trans('belich::' . static::filterArgument($text)));
        });
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Filter the value
     */
    public static function filterArgument(string $value)
    {
        return str_replace("'", '', $value);
    }
}

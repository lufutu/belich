<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

trait Middlewares
{
    // private array $belichMiddleware = ['belich'];
    // private array $minifyMiddleware = ['minify'];
    private array $belichMiddleware = [];
    private array $minifyMiddleware = [];
    private array $defaultMiddleware = [
        'web',
        'auth:sanctum',
        'https',
    ];

    /**
     * Get the config middleware
     */
    public function middleware(): array
    {
        //Add the Belich middleware to the custom middleware
        $middleware = array_merge(config('belich.middleware'), $this->belichMiddleware);

        return count(config('belich.middleware')) > 0
            // Add the minify middleware to the configuration file (if its exists)
            ? $this->minifyMiddleware($middleware)
            // Only the default middleware
            : $this->defaultMiddleware();
    }

    /**
     * Add or not the minify middleware
     */
    private function minifyMiddleware(array $middleware): array
    {
        return config('belich.minifyHtml.enable') === true
            ? array_merge($middleware, $this->minifyMiddleware)
            : $middleware;
    }

    /**
     * Default middleware
     */
    private function defaultMiddleware(): array
    {
        return array_merge(
            $this->defaultMiddleware,
            $this->belichMiddleware
        );
    }
}

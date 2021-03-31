<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

trait Middlewares
{
    // private array $packageMiddleware = ['belich', 'minify'];
    private array $packageMiddleware = [];
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
        return count(config('belich.middleware')) > 0

            // Add the middleware from the configuration file [/config/belich.php] and the package middlewar
            ? $this->setMiddleware(config('belich.middleware'))

            // Only the default middleware
            : $this->setMiddleware(this->defaultMiddleware);
    }

    /**
     * Merge the middleware, with the package middleware
     */
    private function setMiddleware(array $middleware): array
    {
        return array_merge(
            $middleware,
            $this->packageMiddleware
        );
    }
}

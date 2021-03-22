<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Components\Helpers;

trait Paths
{
    /**
     * Get the package namespace path
     */
    public function namespace_path(string $file): string
    {
        return '\\Daguilarm\\Belich\\' . $file;
    }

    /**
     * Get the resource path
     */
    public function route_path(string $file): string
    {
        return sprintf('%s/%s', config('belich.path'), $file);
    }

    /**
     * Built belich urls
     */
    public function belich_path(?string $resource = null): string
    {
        return sprintf(
            '%s%s/%s',
            config('belich.url'),
            config('belich.path'),
            $resource
        );
    }
}

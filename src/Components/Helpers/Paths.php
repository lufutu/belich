<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Components\Helpers;

trait Paths
{
    /**
     * Get the package namespace path [\Daguilarm\Belich\ClassName]
     */
    public function namespace_path(string $className): string
    {
        return '\\Daguilarm\\Belich\\' . $className;
    }

    /**
     * Get the resource namespace [\\App\\Belich\\Resources\\ResourceName\\Table::class]
     */
    public function resource_namespace(string $resourceName): string
    {
        return sprintf('\\App\\Belich\\Resources\\%s\\Table', $resourceName);
    }

    /**
     * Get the testing resource fixture namespace [\\Daguilarm\\Belich\\Tests\\Fixtures\\ResourceName\\Table::class]
     */
    public function testing_namespace(string $resourceName): string
    {
        return sprintf('\\Daguilarm\\Belich\\Tests\\Fixtures\\%s\\Table', $resourceName);
    }

    /**
     * Get the route path [dashboard/fileName]
     */
    public function route_path(string $fileName): string
    {
        return sprintf('%s/%s', config('belich.path'), $fileName);
    }

    /**
     * Get the resource path [./app/Belich/Resources/fileName]
     */
    public function resource_path(string $fileName): string
    {
        return app_path('Belich/Resources/' . $fileName);
    }

    /**
     * Built belich urls [https://www.domain.com/dashboard/resource]
     */
    public function belich_path(?string $resource): string
    {
        return sprintf(
            '%s%s/%s',
            config('belich.url'),
            config('belich.path'),
            $resource
        );
    }
}

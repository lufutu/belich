<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Daguilarm\Belich\Facades\Belich;
use Daguilarm\Belich\Facades\Helper;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait ResourcesAuxiliar
{
    /**
     * Get all the items from a resource
     */
    private function getResourceFile(string $resourceName): string
    {
        return Belich::hasTestingEnvironment()
            // Only for testing
            ? Helper::testing_namespace($resourceName)
            // Current value
            : Helper::resource_namespace($resourceName);
    }

    /**
     * Get all the files from the resources folder (All the resources)
     */
    private function resourcesFolder(): Collection
    {
        $currentFolder = Belich::hasTestingEnvironment()
            // Testing folder
            ? $this->testingResourcesPath()
            // Resource folder
            : $this->defaultResourcesPath();

        return $this->resourcesFolderFiles($currentFolder);
    }

    /**
     * Default path for resources
     */
    private function defaultResourcesPath(): string
    {
        return config('belich.resources');
    }

    /**
     * Testing path for resources
     */
    private function testingResourcesPath(): string
    {
        return 'tests/Fixtures/Resources';
    }

    /**
     * Get all the files from the resource's folder
     */
    private function resourcesFolderFiles(string $folder): Collection
    {
        return collect(scandir($folder));
    }

    /**
     * Get all the file name
     */
    private function fileName(string $file): string
    {
        return Str::of($file)
            ->explode('.')
            ->first();
    }

    /**
     * Get the icon value from a resource
     */
    private function resourceIcon(object $class): string
    {
        return $class::$icon ?? config('belich.icons.default') ?? '';
    }

    /**
     * Get the label value from a resource
     */
    private function resourceLabel(object $class, string $resourceName): string
    {
        $altLabel = Str::of($resourceName)
            ->title()
            ->singular()
            ->__toString();

        return $class::$label ?? $altLabel;
    }

    /**
     * Get the label value from a resource
     */
    private function resourcePluralLabel(object $class, string $resourceName): string
    {
        $altPluralLabel = Str::of($resourceName)
            ->title()
            ->plural()
            ->__toString();

        return $class::$pluralLabel ?? $altPluralLabel;
    }
}

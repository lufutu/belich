<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Daguilarm\Belich\Facades\Belich;
use Daguilarm\Belich\Facades\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait Resourceable
{
    /**
     * Get all the Belich resources
     */
    public function allResources(): Collection
    {
        return $this->resourcesFolder()
            ->map(static function ($file) {
                return $file;
            })->filter(static function ($value) {
                return $value !== '.' && $value !== '..';
            })->mapWithKeys(function ($file) {
                // Define the current resource
                $resourceName = $this->fileName($file);

                // Get all the navegation values from the current resource
                return [$resourceName => $this->navigationFields($resourceName)];
            });
    }

    /**
     * Get the basic values to generate the navigation links
     */
    public function navigationFields(string $resourceName): Collection
    {
        $class = app($this->resourceFile($resourceName));

        return collect([
            'class' => $resourceName,
            'displayInNavigation' => $class::$displayInNavigation,
            // 'group' => $class::$group,
            // 'icon' => $class::$icon ?? config('belich.navbar.defaultIcon') ?? '',
            'label' => $class::$label ?? Str::title($resourceName),
            'pluralLabel' => $class::$pluralLabel ?? Str::plural(Str::title($resourceName)),
            'resource' => $resourceName,
        ]);
    }

    /**
     * Get all the items from a resource
     */
    private function resourceFile(string $resourceName): string
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
     * Testing path for resources
     */
    private function testingResourcesPath(): string
    {
        return 'tests/Fixtures/Resources';
    }

    /**
     * Default path for resources
     */
    private function defaultResourcesPath(): string
    {
        return config('belich.resources');
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
        return Str::title(explode('.', $file)[0]);
    }
}

<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Daguilarm\Belich\Facades\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait Resourceable
{
    /**
     * Get all the Belich resources for send globaly to the views
     */
    public function getResources(?string $testingFolder): Collection
    {
        return $this->resourcesFolder($testingFolder)
            ->map(static function ($file) {
                return $file;
            })->filter(static function ($value) {
                return $value !== '.' && $value !== '..';
            })->mapWithKeys(function ($file) use ($testingFolder) {
                // Define the current resource
                $resource = $this->fileName($file);
                // Get all the values from the resources
                $resourceClass = $this->resourceValues($testingFolder, $resource);

                return [$resource => $resourceClass];
            });
    }

    /**
     * Get all the files from the resources folder (All the resources)
     */
    private function resourcesFolder(?string $testingFolder): Collection
    {
        $currentFolder = $testingFolder ?? $this->defaultResourcesFolder();

        return $this->resourcesFolderFiles($currentFolder);
    }

    /**
     * Default resource's folder
     */
    private function defaultResourcesFolder(): string
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
     * Get all the items from a resource
     */
    private function resourceValues(?string $testingFolder, string $resourceName): Object
    {
        $file = $testingFolder
            // Only for testing
            ? Helper::testing_namespace($resourceName)
            // Current value
            : Helper::resource_namespace($resourceName);

        return app($file);
    }

    /**
     * Get all the file name
     */
    private function fileName(string $file): string
    {
        return Str::title(explode('.', $file)[0]);
    }
}

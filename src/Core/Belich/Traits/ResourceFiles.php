<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Daguilarm\Belich\Facades\Belich;
use Daguilarm\Belich\Facades\Helper;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait ResourceFiles
{
    /**
     * Get all the items from a resource
     */
    private function getResourcesFile(string $resourceName): string
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
    private function getResourcesFolder(): Collection
    {
        $currentFolder = Belich::hasTestingEnvironment()
            // Testing folder
            ? $this->getResourcesPathForTesting()
            // Resource folder
            : $this->getResourcesPath();

        return $this->getResourcesFolderContent($currentFolder);
    }

    /**
     * Default path for resources
     */
    private function getResourcesPath(): string
    {
        return config('belich.resources') || app_path('Belich/Resources');
    }

    /**
     * Testing path for resources
     */
    private function getResourcesPathForTesting(): string
    {
        return 'tests/Fixtures/Resources';
    }

    /**
     * Get all the files from the resource's folder
     */
    private function getResourcesFolderContent(string $folder): Collection
    {
        return collect(scandir($folder));
    }

    /**
     * Get all the file name
     */
    private function getFileName(string $file): string
    {
        return Str::of($file)
            ->explode('.')
            ->first();
    }
}

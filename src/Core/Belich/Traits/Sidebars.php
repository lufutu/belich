<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Illuminate\Support\Collection;

trait Sidebars
{
    /**
     * Prepare all the navigation fields for the sidebar
     */
    public function sidebar(?Collection $data = null): Collection
    {
        $resources = is_null($data)
            ? $this->getAllResources()
            : $data;

        return $resources
            ->groupBy(['group'])
            ->sortBy(['pluralLabel']);
    }

    /**
     * Get all the Belich resources to show in the sidebar
     */
    private function getAllResourcesForSidebar(): Collection
    {
        return $this->getResourcesFolder()
            ->map(static function ($file) {
                return $file;
            })->filter(static function ($value) {
                return $value !== '.' && $value !== '..';
            })->mapWithKeys(function ($file) {
                // Define the current resource
                $resourceName = $this->getFileName($file);

                // Get all the navegation values from the current resource
                return [$resourceName => $this->populateNavigationFieldsForSidebar($resourceName)];
            });
    }

    /**
     * Get the basic values to generate the navigation links for the sidebar
     */
    private function populateNavigationFieldsForSidebar(string $resourceName): Collection
    {
        // Get the default values
        $class = app($this->getResourcesFile($resourceName));
        $title = $this->resourcePluralLabel($class, $resourceName);

        return collect([
            'class' => $resourceName,
            'allowAccessToResource' => $class::$allowAccessToResource,
            'displayInNavigation' => $class::$displayInNavigation,
            'group' => $class::$group ?? $title,
            'icon' => $this->resourceIcon($class),
            'label' => $this->resourceLabel($class, $resourceName),
            'pluralLabel' => $title,
            'resource' => $resourceName,
        ]);
    }
}

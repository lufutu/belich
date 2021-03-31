<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Illuminate\Support\Collection;

trait Resources
{
    use ResourcesAuxiliar;

    /**
     * Prepare all the navigation fields for the sidebar
     */
    public function sidebarNavigation(): Collection
    {
        return collect($this->getAllResourcesForSidebar())
            ->map(static function ($item) {
                return $item['displayInNavigation'] === true
                    ? $item->forget('displayInNavigation')
                    : null;
            })
            ->filter()
            ->values()
            ->groupBy(['group'])
            ->sortBy(['pluralLabel']);
    }

    /**
     * Get all the Belich resources to show in the sidebar
     */
    private function getAllResourcesForSidebar(): Collection
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
                return [$resourceName => $this->createNavigationFieldsForSidebar($resourceName)];
            });
    }

    /**
     * Get the basic values to generate the navigation links for the sidebar
     */
    private function createNavigationFieldsForSidebar(string $resourceName): Collection
    {
        $class = app($this->getResourceFile($resourceName));
        $title = $this->resourcePluralLabel($class, $resourceName);

        return collect([
            'class' => $resourceName,
            'displayInNavigation' => $class::$displayInNavigation,
            'group' => $class::$group ?? $title,
            'icon' => $this->resourceIcon($class),
            'label' => $this->resourceLabel($class, $resourceName),
            'pluralLabel' => $title,
            'resource' => $resourceName,
        ]);
    }
}

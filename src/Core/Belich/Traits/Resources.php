<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Illuminate\Support\Collection;

trait Resources
{
    use ResourcesAuxiliar;

    /**
     * Prepare all the navigation fields
     */
    public function displayNavigation(): Collection
    {
        return collect($this->getAllResources())
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
     * Prepare the group elements
     */
    public function displayGroup(Collection $group): array
    {
        return $group->map(function ($items) {
            return $items['icon']
                ? ['text' => $items['group'], 'icon' => $items['icon']]
                : [];
        })
            ->first();
    }

    /**
     * Get all the Belich resources
     */
    private function getAllResources(): Collection
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
                return [$resourceName => $this->createNavigationFields($resourceName)];
            });
    }

    /**
     * Get the basic values to generate the navigation links
     */
    private function createNavigationFields(string $resourceName): Collection
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

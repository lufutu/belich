<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Daguilarm\Belich\Facades\Belich;
use Illuminate\Support\Str;

trait Resources
{
    use ResourceFiles,
        ResourceAttributes;

    private array $resourcesPathFilter = ['//', '///', '////'];

    /**
     * Get the resource $allowAccessToResource variable from the resource.
     */
    public function getAllowAccessToResource(): bool
    {
    }

    /**
     * Get the resource class
     */
    public function getResource(string $resource): object
    {
        $class = sprintf(
            '%s\\%s\\Index',
            $this->getResourcePath(),
            $this->getClassFolderName($resource),
        );

        return app($class);
    }

    /**
     * Get the app name.
     */
    public function name(): string
    {
        return config('belich.name', 'Belich Dashboard');
    }

    /**
     * Get the app path [/dashboard].
     */
    public function path(): string
    {
        return str_replace(
            $this->resourcesPathFilter,
            '',
            config('belich.path', '/dashboard')
        );
    }

    /**
     * Get the app path name [dashboard].
     */
    public function pathName(): string
    {
        return str_replace(
            array_merge(['/'], $this->resourcesPathFilter),
            '',
            self::path()
        );
    }

    /**
     * Get the app url.
     */
    public function url(): string
    {
        $url = sprintf('%s/%s', request()->root(), self::path());

        return str_replace(
            $this->resourcesPathFilter,
            '/',
            $url
        );
    }

    /**
     * Get the formated class name
     */
    private function getClassFolderName(string $className): string
    {
        return Str::of($className)
            ->title()
            ->plural()
            ->__toString();
    }

    /**
     * Get the resource class path
     */
    private function getResourcePath(): string
    {
        return Belich::hasTestingEnvironment()
            ? '\\Daguilarm\\Belich\\Tests\\Fixtures\\Resources'
            : '\\App\\Belich\\Resources';
    }
}

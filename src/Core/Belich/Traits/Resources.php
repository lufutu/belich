<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Daguilarm\Belich\Facades\Belich;
use Daguilarm\Belich\Facades\BelichRequest;
use Illuminate\Support\Str;

trait Resources
{
    use ResourceFiles,
        ResourceAttributes;

    private array $resourcesPathFilter = ['//', '///', '////'];

    /**
     * Get the resource $allowAccessToResource variable from the resource.
     */
    public function getAllowAccessToResource(?string $resource = null): bool
    {
        $class = $this->getResource();

        // If the page is not a resource (for example the dashboard view) the default value is true.
        return $class::$allowAccessToResource ?? true;
    }

    /**
     * Get the resource class
     */
    public function getResource(?string $resource = null): object
    {
        $resource = $this->getResourceClassName($resource);

        if(!is_object($resource)) {
            return collect([]);
        }

        $class = sprintf(
            '%s\\%s\\Index',
            $this->getResourcePath(),
            $this->getClassFolderName($resource),
        );

        return app($class);
    }

    /**
     * Get the resource class Name
     */
    public function getResourceClassName(?string $resource = null): string
    {
        return $resource ?: BelichRequest::resource();
    }

    /**
     * Get the resource name.
     */
    public function url(): string
    {
        $url = request()->root() . $this->path();

        return sprintf('%s/%s', $url, $this->getResourceClassName());
    }

    /**
     * Get the Belich app name.
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

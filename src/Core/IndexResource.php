<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core;

use Illuminate\Http\Request;

abstract class IndexResource
{
    /** @var array<string> */
    public static array $relationships = [];
    /** @var array<string> */
    public static array $search = [];
    public static bool $allowAccessToResource = true;
    public static bool $displayInNavigation = true;
    public static bool $softDeletes = false;
    public static bool $tabs = false;
    public static bool $downloable = false;
    public static string $icon;
    public static string $label;
    public static string $model;
    public static string $pluralLabel;
    public static string $group = '';
    public static string $redirectTo = '';

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<string>
     */
    abstract public function columns(Request $request): array;

    /**
     * Set the resource model
     */
    // public function model(): object
    // {
    //     $model = static::$model;
    //     $relationships = static::$relationships;

    //     return $relationships
    //         ? app($model)->with($relationships)
    //         : app($model);
    // }
}

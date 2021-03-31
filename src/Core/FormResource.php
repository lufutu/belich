<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class FormResource
{
    public static Collection $fields;

    /** @var array<string> */
    public static array $relationships = [];
    /** @var array<string> */
    public static array $search = [];
    public static bool $accessToResource = true;
    public static bool $displayInNavigation = true;
    public static bool $softDeletes = false;
    public static bool $tabs = false;
    public static bool $downloable = false;
    public static string $controllerAction;
    public static string $icon;
    public static string $label;
    public static string $model;
    public static string $pluralLabel;
    public static ?string $group = null;
    public static ?string $redirectTo = null;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<string>
     */
    abstract public function fields(Request $request): array;
}

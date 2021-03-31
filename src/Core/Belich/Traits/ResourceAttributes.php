<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

use Illuminate\Support\Str;

trait ResourceAttributes
{
    /**
     * Get the icon value from a resource
     */
    private function resourceIcon(object $class): string
    {
        return $class::$icon ?? config('belich.icons.default') ?? '';
    }

    /**
     * Get the label value from a resource
     */
    private function resourceLabel(object $class, string $resourceName): string
    {
        $altLabel = Str::of($resourceName)
            ->title()
            ->singular()
            ->__toString();

        return $class::$label ?? $altLabel;
    }

    /**
     * Get the label value from a resource
     */
    private function resourcePluralLabel(object $class, string $resourceName): string
    {
        $altPluralLabel = Str::of($resourceName)
            ->title()
            ->plural()
            ->__toString();

        return $class::$pluralLabel ?? $altPluralLabel;
    }
}

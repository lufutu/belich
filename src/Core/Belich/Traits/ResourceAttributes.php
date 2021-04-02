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
        $label = $this->resourceLabelFormat($class::$label, 'singular');
        $altLabel = $this->resourceLabelFormat($resourceName, 'singular');

        return $label ?? $altLabel;
    }

    /**
     * Get the label value from a resource
     */
    private function resourcePluralLabel(object $class, string $resourceName): string
    {
        $label = $this->resourceLabelFormat($class::$pluralLabel);
        $altLabel = $this->resourceLabelFormat($resourceName);

        return $label ?? $altLabel;
    }

    private function resourceLabelFormat(string $label, string $quantity = 'plural')
    {
        $label = Str::of($label)->ucfirst();

        return $quantity === 'plural'
            ? $label->plural()->__toString()
            : $label->singular()->__toString();
    }
}

<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Components\Helpers;

trait Blade
{
    /**
     * Hide content base on screen size
     */
    public function hideContainerForScreens(array $hideFor): string
    {
        $screens = collect(['sm', 'md', 'lg', 'xl']);

        return $screens
            ->map(static function ($size) use ($hideFor) {
                $status = in_array($size, $hideFor) ? 'hidden' : 'flex';

                return sprintf('%s:%s', $size, $status);
            })
            ->filter()
            ->prepend('hidden')
            ->implode(' ');
    }

    /**
     * Hide cards or metrics base on screen size
     */
    public function hideComponentsForScreens(): string
    {
        return self::hideContainerForScreens(config('belich.hideComponentsForScreens'));
    }
}

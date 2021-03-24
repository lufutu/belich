<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Services\Helpers;

trait Strings
{
    /**
     * Set the default value for a empty string or result
     */
    public function emptyResults(): string
    {
        return '—';
    }

    /**
     * Remove stuff that may bother to Mr. php
     */
    public function stringSanitize(?string $string): string
    {
        $replace = ['!', '"', '/', '@', '#', '$', '%', '&', '(', ')', '€', '^', '*', '{', '}', '-', '.', ',', ';', ' '];

        return str_replace($replace, '_', $string);
    }
}

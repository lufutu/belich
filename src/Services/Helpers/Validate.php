<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Services\Helpers;

trait Validate
{
    /**
     * Validate ip address
     */
    public function validateIp(?string $ipAddress): bool
    {
        return filter_var($ipAddress, FILTER_VALIDATE_IP);
    }

    /**
     * String has a validad php structure
     */
    public function validatePhp(?string $string): bool
    {
        return preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $string) === 1
            ? true
            : false;
    }

    /**
     * Validate url
     */
    public function validateUrl(?string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}

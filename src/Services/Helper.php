<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Services;

use Daguilarm\Belich\Services\Helpers\Blade;
use Daguilarm\Belich\Services\Helpers\Models;
use Daguilarm\Belich\Services\Helpers\Paths;
use Daguilarm\Belich\Services\Helpers\Strings;
use Daguilarm\Belich\Services\Helpers\Time;
use Daguilarm\Belich\Services\Helpers\Validate;

final class Helper
{
    use Blade,
        Models,
        Paths,
        Strings,
        Time,
        Validate;

    /**
     * Generate helper's methods
     *
     * @param array<int,string> $parameters
     */
    public function __call(string $method, array $parameters): method
    {
        if (method_exists($this, $method)) {
            $reflection = new \ReflectionMethod($this, $method);
            if ($reflection->isPublic()) {
                return call_user_func_array([$this, $method], $parameters);
            }
        }

        abort(403, sprintf('The method %s() not exists', $method));
    }
}

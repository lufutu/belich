<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Components;

use Daguilarm\Belich\Components\Helpers\Blade;
use Daguilarm\Belich\Components\Helpers\Models;
use Daguilarm\Belich\Components\Helpers\Paths;
use Daguilarm\Belich\Components\Helpers\Strings;
use Daguilarm\Belich\Components\Helpers\Time;
use Daguilarm\Belich\Components\Helpers\Validate;

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

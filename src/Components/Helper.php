<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Components;

use Daguilarm\Belich\Components\Helpers\Time;

final class Helper
{
    use Time;

    /**
     * Generate helper's methods
     */
    public function __call(string $method, array $parameters)
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

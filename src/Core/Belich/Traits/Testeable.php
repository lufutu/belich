<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

trait Testeable
{
    /**
     * Check for a testing environment
     */
    public function hasTestingEnvironment(): bool
    {
        return app()->environment('testing');
    }
}

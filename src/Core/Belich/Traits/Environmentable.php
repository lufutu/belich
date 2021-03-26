<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core\Belich\Traits;

trait Environmentable
{
    /**
     * Check for a testing environment
     */
    public function hasTestingEnvironment(): bool
    {
        return app()->environment('testing');
    }

    /**
     * Check for a production environment
     */
    public function hasProductionEnvironment(): bool
    {
        return app()->environment('production');
    }
}

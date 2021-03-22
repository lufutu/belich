<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Facades;

use Illuminate\Support\Facades\Facade;

final class Belich extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Belich';
    }
}

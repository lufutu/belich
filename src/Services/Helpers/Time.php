<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Services\Helpers;

use Carbon\Carbon;

trait Time
{
    /**
     * Set time for cookies
     */
    public function timeForCookie(): int
    {
        return Carbon::now()->addYear()->timestamp;
    }
}

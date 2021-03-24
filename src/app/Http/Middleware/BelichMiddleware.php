<?php

declare(strict_types=1);

namespace Daguilarm\Belich\App\Http\Middleware;

use Closure;
use Daguilarm\Belich\Core\Belich;
use Daguilarm\Belich\Facades\Helper;
use Illuminate\Http\Request;

final class BelichMiddleware
{
    private int $perPage = 20;
    private string $withTrashed = 'none';

    /**
     * Set the Belich middleware
     */
    public function handle(Request $request, Closure $next): Illuminate\Http\Request
    {
        // Authorized access to resource
        if (Belich::accessToResource() === false) {
            return abort(403);
        }

        //Set base middleware response
        $response = $next($request);

        // Default results per page cookie
        if (! $request->cookie('belich_perPage')) {
            $response = $response->withCookie(cookie('belich_perPage', $this->perPage, Helper::timeForCookie()));
        }

        // Default trashed results cookie
        if (! $request->cookie('belich_withTrashed')) {
            $response = $response->withCookie(cookie('belich_withTrashed', $this->withTrashed, Helper::timeForCookie()));
        }

        return $response;
    }
}

<?php

declare(strict_types=1);

namespace Daguilarm\Belich\App\Http\Middleware;

use Closure;
use Daguilarm\Belich\Facades\Belich;
use Daguilarm\Belich\Facades\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class BelichMiddleware
{
    private int $perPage = 20;
    private bool $withTrashed = false;

    /**
     * Set the Belich middleware
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Authorized access to resource
        $accessToResource = Belich::getAllowAccessToResource();

        if (is_bool($accessToResource) && $accessToResource === false) {
            return abort(403);
        }

        //Set base middleware response
        $response = $next($request);

        // Default results per page cookie
        if (! $request->cookie('belich_perPage')) {
            $response = $response->withCookie(cookie('belich_perPage', $this->perPage, Helper::setTimeForCookie()));
        }

        // Default trashed results cookie
        if (! $request->cookie('belich_withTrashed')) {
            $response = $response->withCookie(cookie('belich_withTrashed', $this->withTrashed, Helper::setTimeForCookie()));
        }

        return $response;
    }
}

<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Http\Middleware;

use Closure;

final class HttpsMiddleware
{
    /**
     * Force to secure URL
     */
    public function handle($request, Closure $next)
    {
        if (! $request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}

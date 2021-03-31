<?php

declare(strict_types=1);

namespace Daguilarm\Belich\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class HttpsMiddleware
{
    /**
     * Force to secure URL
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}

<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Providers;

use Daguilarm\Belich\Facades\Belich;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider as Provider;
use Illuminate\Support\Str;

final class RequestServiceProvider extends Provider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        // Get all the parameters from the URL in a Request
        Request::macro('getParameters', function (): array {
            $request = Request::route()->getName();
            $requestValues = Str::of($request)
                ->explode('.')
                ->toArray();

            return is_null($requestValues)
                ? []
                : $requestValues;
        });

        // Get all the action from the URL in a Request
        Request::macro('action', function (): ?string {
            $request = Request::getParameters();
            $action = end($request);

            return in_array($action, Belich::getAllowedActions())
                ? $action
                : null;
        });

        // Get all the action from the URL in a Request
        Request::macro('resource', function (): ?string {
            $request = Request::getParameters();

            return Str::of($request[1])
                ->plural()
                ->lower();
        });

        // Get all the resource ID from the URL in a Request
        Request::macro('resourceId', function (): ?int {
            // The resource variable is singular
            $resource = Str::of(Request::resource())->singular;
            $resourceId = request()->route($resource);

            if (is_numeric($resourceId)) {
                return (int) $resourceId;
            }

            return null;
        });
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
    }
}

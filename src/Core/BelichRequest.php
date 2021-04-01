<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core;

use Daguilarm\Belich\Facades\Belich;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

final class BelichRequest
{
    /**
     * Get all the URL parameters from a Request
     */
    public function parameters(): array
    {
        $requestRoute = Request::route()->getName();
        $requestValues = Str::of($requestRoute)
            ->explode('.')
            ->toArray();

        return is_null($requestValues)
            ? []
            : $requestValues;
    }

    /**
     * Get the URL action from a Request
     */
    public function action(): ?string
    {
        $action = $this->parameters()[2] ?? null;

        return in_array($action, Belich::getAllowedActions())
            ? $action
            : null;
    }

    /**
     * Get the URL resource name from a Request
     */
    public function resource(): ?string
    {
        $requestResource = $this->parameters()[1] ?? null;

        return Str::of($requestResource)
            ->plural()
            ->lower()
            ->__toString();
    }

    /**
     * Get the URL resource ID from a Request
     */
    public function id(): ?int
    {
        // Get the value from the variable
        $resourceId = request()->route(
            // Set the variable
            $this->resourceVariable()
        );

        return is_numeric($resourceId)
            ? (int) $resourceId
            : null;
    }

    /**
     * Get the variable name from the Route Request [Ex: dashboard/users/{user}]
     */
    private function resourceVariable(): ?string
    {
        return Str::of($this->resource())
            ->singular;
    }
}

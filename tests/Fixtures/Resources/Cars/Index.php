<?php

namespace Daguilarm\Belich\Tests\Fixtures\Resources\Cars;

use Daguilarm\Belich\Core\IndexResource;
use Illuminate\Http\Request;

final class Index extends IndexResource
{
    public static string $group = "Sección 1";
    public static string $label = "Coche";
    public static string $pluralLabel = "Coches";

    public function columns(Request $request): array
    {
        return [];
    }
}

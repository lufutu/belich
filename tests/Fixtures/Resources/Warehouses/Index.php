<?php

namespace Daguilarm\Belich\Tests\Fixtures\Resources\Warehouses;

use Daguilarm\Belich\Core\IndexResource;
use Illuminate\Http\Request;

final class Index extends IndexResource
{
    public static string $group = "Sección 2";
    public static string $label = "Almacén";
    public static string $pluralLabel = "Almacences";

    public function columns(Request $request): array
    {
        return [];
    }
}

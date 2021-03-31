<?php

namespace Daguilarm\Belich\Tests\Fixtures\Resources\Users;

use Daguilarm\Belich\Core\IndexResource;
use Illuminate\Http\Request;

final class Index extends IndexResource
{
    public static string $group = "Sección 1";
    public static string $label = "Usuario";
    public static string $pluralLabel = "Usuarios";

    public function table(Request $request): array
    {
        return [];
    }
}

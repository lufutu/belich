<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core;

use Daguilarm\Belich\Core\Belich\Traits\Resourceable;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class Belich
{
    use Resourceable;

    protected array $allowedActions = ['index', 'create', 'edit', 'show'];
    protected int $perPage = 0;
    protected object $request;
    protected object $user;

    public function __construct()
    {
        $this->request = new Request();
        $this->user = \Illuminate\Support\Facades\Auth::user() ?? collect();

        //Set pagination
        if ($this->request->has('perPage')) {
            $this->perPage = $this->request->perPage;
        }
    }
}

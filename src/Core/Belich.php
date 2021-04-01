<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Core;

use Daguilarm\Belich\Core\Belich\Traits\Environments;
use Daguilarm\Belich\Core\Belich\Traits\Middlewares;
use Daguilarm\Belich\Core\Belich\Traits\Resources;
use Daguilarm\Belich\Core\Belich\Traits\Sidebars;
use Illuminate\Http\Request;

final class Belich
{
    use Environments,
        Middlewares,
        Resources,
        Sidebars;

    /** @var array<string> */
    protected array $allowedActions = ['index', 'create', 'edit', 'show'];
    protected int $perPage = 0;
    protected object $request;
    protected object $user;

    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->user = \Illuminate\Support\Facades\Auth::user() ?? collect();

        //Set pagination
        if ($this->request->has('perPage')) {
            $this->perPage = $this->request->perPage;
        }
    }

    /**
     * Get the allowed actions for a Request
     */
    public function getAllowedActions()
    {
        return $this->allowedActions;
    }

    /**
     * Get the results per page
     */
    public function getPerPage()
    {
        return $this->perPage;
    }
}

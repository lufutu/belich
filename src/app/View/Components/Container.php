<?php

namespace Daguilarm\Belich\App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Container extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('belich::components.container');
    }
}

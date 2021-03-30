<?php

namespace Daguilarm\Belich\App\View\Components;

use Daguilarm\Belich\Facades\Belich;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('belich::components.sidebar');
    }

    public function resources(): string
    {
        return Belich::displayNavigation();
    }
}

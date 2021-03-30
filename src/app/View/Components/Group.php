<?php

namespace Daguilarm\Belich\App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Group extends Component
{
    public array $resource;

    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct(Collection $resource)
    {
        $this->resource = $this->displayGroup($resource);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('belich::components.sidebar.group');
    }

    /**
     * Set the $text variable in the component view
     */
    public function text(): string
    {
        return $this->resource['text'];
    }

    /**
     * Set the $icon variable in the component view
     */
    public function icon(): string
    {
        return $this->resource['icon'];
    }

    /**
     * Prepare the group elements
     */
    private function displayGroup(Collection $resources): array
    {
        return $resources->map(function ($items) {
            return $items['icon']
                ? ['text' => $items['group'], 'icon' => $items['icon']]
                : [];
        })->first();
    }
}

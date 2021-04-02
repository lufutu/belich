{{-- Sidebar container --}}
<div
    id="menu"
    class="{{ config('belich-theme.sidebar.background') }}"
    @mouseover="isClose = false"
    @mouseleave="isClose = true;"
    x-cloak
>

    {{-- Base container --}}
    <div
        class="flex flex-col justify-between"
        :class="{'is-close': isClose, '{{ config('belich-theme.sidebar.widthClose') }} transition-all duration-500 ease-out': isClose, '{{ config('belich-theme.sidebar.widthOpen') }}': !isClose}"
    >

        {{-- Home icon --}}
        <x-belich-sidebar-home
            :url="route('dashboard')"
            :icon="svg('heroicon-s-home', 'h-5 w-5')"
        />

        {{-- Sidbar links --}}
        <ul class="text-white">

            {{-- Get all the navigation resources. $getAllResources from \Daguilarm\Belich\ServiceProvider --}}
            @foreach(Belich::sidebar($getAllResources) as $resource)

                {{-- Items lists --}}
                <li>

                    {{-- One level resource --}}
                    @if($resource->count() <= 1)

                        {{-- Get the unique item --}}
                        <x-belich-sidebar-link
                            :url="route('dashboard')"
                            :icon="$resource->first()->get('icon')"
                            :text="$resource->first()->get('pluralLabel')"
                        />

                    {{-- two level resource --}}
                    @else

                        {{-- Get the group elements. See Daguilarm\Belich\App\View\Components\Group --}}
                        <x-belich-sidebar-group :resource="$resource">

                            {{-- List of items --}}
                            @foreach($resource as $item)
                                <x-belich-sidebar-group-link
                                    :url="route('dashboard')"
                                    :text="$item->get('pluralLabel')"
                                />
                            @endforeach

                        </x-belich-sidebar-group>
                    @endif

                </li>

            @endforeach

        </ul>

    </div>

</div>

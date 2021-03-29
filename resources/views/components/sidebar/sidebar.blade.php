{{-- Main container --}}
<div
    id="menu"
    class="bg-gray-700"
    @mouseover="isClose = false"
    @mouseleave="isClose = true"
>

    {{-- Base container --}}
    <div
        class="flex flex-col justify-between"
        :class="{'is-close': isClose, 'w-16': isClose, 'w-48': !isClose}"
    >

        {{-- Home --}}
        <x:belich::sidebar.home :url="route('belich.dashboard')" :icon="svg('heroicon-s-home', 'h-5 w-5')"></x:belich::sidebar.home>

        {{-- Link container --}}
        <ul class="text-white">

            {{-- Get all the navigation resources --}}
            @foreach(Belich::displayNavigationFields() as $resource)

                {{-- Items lists --}}
                <li>

                    {{-- One level resource --}}
                    @if($resource->count() <= 1)

                        {{-- Get the unique item --}}
                        <x:belich::sidebar.link
                            :url="route('belich.dashboard')"
                            :icon="$resource->first()->get('icon')"
                        >
                            {{ $resource->first()->get('pluralLabel') }}
                        </x:belich::sidebar.link>

                    {{-- two level resource --}}
                    @else
                        <x:belich::sidebar.group
                            :text="$resource->first()->get('pluralLabel')"
                            :icon="$resource->first()->get('icon')"
                        >

                            {{-- List of items --}}
                            @foreach($resource as $item)
                                <x:belich::sidebar.group-link
                                    :url="route('belich.dashboard')"
                                >
                                    {{ $item->get('pluralLabel') }}
                                </x:belich::sidebar.group-link>
                            @endforeach

                        </x:belich::sidebar.group>
                    @endif

                </li>

            @endforeach

        </ul>

    </div>

</div>

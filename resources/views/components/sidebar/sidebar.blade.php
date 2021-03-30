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
        <x:belich::sidebar.home
            :url="route('belich.dashboard')"
            :icon="svg('heroicon-s-home', 'h-5 w-5')"
        />

        {{-- Link container --}}
        <ul class="text-white">

            {{-- Get all the navigation resources --}}
            @foreach(Belich::displayNavigation() as $resource)

                {{-- Items lists --}}
                <li>

                    {{-- One level resource --}}
                    @if($resource->count() <= 1)

                        {{-- Get the unique item --}}
                        <x:belich::sidebar.link
                            :url="route('belich.dashboard')"
                            :icon="$resource->first()->get('icon')"
                            :text="$resource->first()->get('pluralLabel')"
                        />

                    {{-- two level resource --}}
                    @else

                        {{-- Set the group elements --}}
                        @php $group = Belich::displayGroup($resource); @endphp

                        {{-- Get the group elements --}}
                        <x:belich::sidebar.group
                            :text="$group['text']"
                            :icon="$group['icon']"
                        >

                            {{-- List of items --}}
                            @foreach($resource as $item)
                                <x:belich::sidebar.group-link
                                    :url="route('belich.dashboard')"
                                    :text="$item->get('pluralLabel')"
                                />
                            @endforeach

                        </x:belich::sidebar.group>
                    @endif

                </li>

            @endforeach

        </ul>

    </div>

</div>

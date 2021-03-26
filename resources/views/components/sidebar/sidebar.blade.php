<div
    id="menu"
    class="bg-gray-700"
    @mouseover="isClose = false"
    @mouseleave="isClose = true"
>
    <div
        class="flex flex-col justify-between"
        :class="{'is-close': isClose, 'w-16': isClose, 'w-48': !isClose}"
    >
        {{-- Home --}}
        <x:belich::sidebar.home :url="route('belich.dashboard')" :icon="svg('heroicon-s-home', 'h-5 w-5')"></x:belich::sidebar.home>
        {{-- Resources links --}}
        <ul class="text-white">
            <li>
                <x:belich::sidebar.link :url="route('belich.dashboard')" icon="heroicon-s-home">
                    Text 1
                </x:belich::sidebar.link>
            </li>
            <li>
                <x:belich::sidebar.group text="Group 1" icon="heroicon-s-globe">
                    <x:belich::sidebar.link text="Text 1" :url="route('belich.dashboard')"></x:belich::sidebar.link>
                    <x:belich::sidebar.link text="Text 2" :url="route('belich.dashboard')"></x:belich::sidebar.link>
                    <x:belich::sidebar.link text="Text 3" :url="route('belich.dashboard')"></x:belich::sidebar.link>
                </x:belich::sidebar.group>
            </li>
        </ul>
    </div>
</div>

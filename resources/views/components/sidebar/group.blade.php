{{-- Get the group elements. See Daguilarm\Belich\App\View\Components\Group --}}
<div x-data="{ toggle: true }">

    <a
        href="javascript:void(0);"
        class="flex items-center p-3  border-b border-gray-900 hover:text-yellow-400"
        @click="toggle = !toggle"
        :class="{ 'justify-center': $parent.isClose, 'justify-start': !$parent.isClose }"
    >

        {{-- Group Icon --}}
        @isset($icon)
            <div class="flex flex-wrap content-center">
                @svg($icon, 'h-5 w-5')
            </div>
        @endisset

        {{-- Group block --}}
        <div
            class="flex ml-2"
            :class="{ 'hidden-item': $parent.isClose }"
        >
            {{-- Group name --}}
            {{ $text }}

            {{-- Conditional icon: up and down --}}
            <div class="flex flex-wrap content-center">
                <svg
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform"
                    :class="{'rotate-180': !toggle, 'rotate-0': toggle}"
                >
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>

        </div>

    </a>

    {{-- Group container for the items from the next level (sublevel) --}}
    <ul
        class="bg-gray-900"
        :class="{ 'hidden': toggle || $parent.isClose }"
    >
        {{ $slot }}
    </ul>

</div>

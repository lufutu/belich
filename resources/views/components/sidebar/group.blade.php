<a
    href="javascript:void(0);"
    class="flex items-center p-3 border-b border-gray-900 hover:text-yellow-400"
    :class="isClose ? 'justify-center' : 'justify-start'"
    @click="toggle = !toggle"
>

    {{-- Icon --}}
    @isset($icon)
        <div class="flex flex-wrap content-center">
            @svg($icon, 'h-5 w-5')
        </div>
    @endisset

    {{-- Text block --}}
    <div
        class="flex ml-2"
        :class="isClose ? 'hidden-item' : ''"
    >
        {{-- Text --}}
        {{ $text }}

        {{-- Conditional icon --}}
        <div class="flex flex-wrap content-center">
            @svg('heroicon-s-chevron-down', ['class' => 'ml-1 h-4 w-4', 'x-show' => 'toggle'])
            @svg('heroicon-s-chevron-up', ['class' => 'ml-1 h-4 w-4', 'x-show' => '!toggle'])
        </div>

    </div>

</a>

{{-- Group container --}}
<ul
    class="hidden-item bg-gray-900"
    :class="{'hidden': toggle}"
>
    {{ $slot }}
</ul>

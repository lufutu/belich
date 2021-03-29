<a
    href="{{ $url }}"
    class="flex content-center block p-3 border-b border-gray-900 text-white hover:text-yellow-400"
    :class="isClose ? 'justify-center' : 'justify-start'"
>
    @isset($icon)
        <div class="flex flex-wrap content-center">
            @svg($icon, 'h-5 w-5')
        </div>
    @endisset
    @isset($slot)
        <div
            class="ml-2 hidden-item"
        >
            {{ $slot }}
        </div>
    @endisset
</a>

{{-- Gruped link --}}
<a
    href="{{ $url }}"
    class="flex content-center block p-3 border-b border-gray-700 text-white hover:text-yellow-400 hover:bg-black"
>

    {{-- Default Icon --}}
    <div class="flex flex-wrap content-center ml-4">
        @svg('heroicon-s-chevron-right', 'h-3 w-3')
    </div>

    {{-- Text or Slot --}}
    <div class="ml-1">

        {{-- Text if available... --}}
        @isset($text)
            {{ $text }}
        {{-- If not, we take the text from the slot --}}
        @else
            {{ $slot }}
        @endisset

    </div>

</a>

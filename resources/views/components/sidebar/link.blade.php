{{-- Link --}}
<a
    href="{{ $url }}"
    class="flex content-center block p-3 border-b {{ config('belich-theme.sidebar.mainLinkBorderColor') }} {{ config('belich-theme.sidebar.mainLinkColor') }} hover:{{ config('belich-theme.sidebar.mainLinkColorHover') }} {{ config('belich-theme.sidebar.mainLinkBackground') }} hover:{{ config('belich-theme.sidebar.mainLinkBackgroundHover') }}"
    :class="isClose ? 'justify-center' : 'justify-start'"
>

    {{-- Icons if available... --}}
    @isset($icon)
        <div class="flex flex-wrap content-center">
            @svg($icon, 'h-5 w-5')
        </div>
    @endisset

    {{-- Text or Slot --}}
    <div class="ml-2 hidden-item">

        {{-- Text if available... --}}
        @isset($text)
            {{ $text }}
        {{-- If not, we take the text from the slot --}}
        @else
            {{ $slot }}
        @endisset

    </div>

</a>

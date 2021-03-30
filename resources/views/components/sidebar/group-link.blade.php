{{-- Gruped link --}}
<a
    href="{{ $url }}"
    class="flex content-center block p-3 border-b {{ config('belich-theme.sidebar.secondaryLinkBorderColor') }} {{ config('belich-theme.sidebar.secondaryLinkColor') }} hover:{{ config('belich-theme.sidebar.secondaryLinkColorHover') }} {{ config('belich-theme.sidebar.secondaryLinkBackground') }} hover:{{ config('belich-theme.sidebar.secondaryLinkBackgroundHover') }}"
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

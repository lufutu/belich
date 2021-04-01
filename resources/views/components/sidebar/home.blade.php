<div class="w-full h-20 bg-{{ config('belich-theme.sidebar.homeLogoColor') }}-400 border-b-2 {{ config('belich-theme.sidebar.homeLogoBorderBottonColor') }} flex items-center justify-center">

    {{-- Link --}}
    <a
        class="w-full flex items-center justify-center block p-2 text-white text-lg"
        href="{{ $url }}"
    >

        {{-- Icon --}}
        <span class="bg-{{ config('belich-theme.sidebar.homeLogoColor') }}-600 rounded-full h-10 w-10 flex items-center justify-center">
            {{ $icon }}
        </span>

    </a>

</div>

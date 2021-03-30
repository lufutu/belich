<div class="h-20 bg-{{ config('belich-theme.sidebar.homeLogoColor') }}-400 border-b-2 border-{{ config('belich-theme.sidebar.homeLogoColor') }}-600 flex items-center justify-center">

    {{-- Link --}}
    <a
        class="block p-4 text-white text-lg"
        href="{{ $url }}"
    >

        {{-- Icon --}}
        <span class=" bg-{{ config('belich-theme.sidebar.homeLogoColor') }}-600 hover:bg-white text-white hover:text-{{ config('belich-theme.sidebar.homeLogoColor') }}-600 rounded-full h-10 w-10 flex items-center justify-center">
            {{ $icon }}
        </span>

    </a>

</div>

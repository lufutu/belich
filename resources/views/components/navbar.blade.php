<div class="h-20 py-2 text-gray-700 bg-white border-b-2 border-gray-200">

    <div
        x-data="{ open: false }"
        class="flex flex-col w-full px-4 mx-auto md:items-center justify-end md:justify-between md:flex-row md:px-6 lg:px-8 my-3 md:my-0"
    >

        {{-- Logo or company name --}}
        <x-belich::navbar.logo />

        <div class="flex justify-end items-center">

            {{-- Notifications --}}
            <div class="flex relative block bg-gray-100 rounded-full w-8 h-8 p-1">

                {{-- Notification ping: Activate only when there is a notification --}}
                <span class="absolute right-0 top-0 animate-ping h-2 w-2 rounded-full bg-{{ config('belich-theme.theme-color') }}-400 opacity-75"></span>

                {{-- Icon --}}
                <x-heroicon-s-bell class="h-6 w-6 text-{{ config('belich-theme.theme-color') }}-400" />

            </div>

            {{-- Navigation dropdown --}}
            <div class="ml-3 flex justify-end">
                <x-jet-dropdown align="right" width="48">

                    {{-- Dropdown trigger --}}
                    <x-belich::navbar.dropdown />

                    {{-- Dropdown content --}}
                    <x-slot name="content">

                        {{-- Account Manager --}}
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        {{-- Profile --}}
                        <x-jet-dropdown-link
                            class="flex items-center"
                            href="{{ route(Belich::pathName() . '.profiles.show') }}"
                        >
                            @svg('heroicon-o-user', 'h-4 w-5 mr-1 text-gray-400')
                            <div>{{ __('Profile') }}</div>
                        </x-jet-dropdown-link>

                        {{-- Separator --}}
                        <div class="border-t border-gray-100"></div>

                        {{-- Logout --}}
                        <x-belich::navbar.logout />

                    </x-slot>

                </x-jet-dropdown>

            </div>

        </div>

    </div>

</div>

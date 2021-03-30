<div class="w-full h-20 py-2 text-gray-700 bg-white border-b-2 border-gray-200">

    <div x-data="{ open: false }" class="flex flex-col w-full px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">

        {{-- Logo or company name --}}
        <x-belich::navbar.logo />

        {{-- Navigation dropdown --}}
        <div class="ml-3 relative">
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
                    <x-jet-dropdown-link href="{{ route('belich.profile.show') }}">
                        {{ __('Profile') }}
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

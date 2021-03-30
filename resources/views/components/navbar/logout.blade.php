<form method="POST" action="{{ route('logout') }}">

    @csrf

    <x-jet-dropdown-link
        href="{{ route('logout') }}"
        class="flex items-center"
        onclick="event.preventDefault(); this.closest('form').submit();"
    >

        @svg('heroicon-o-logout', 'h-4 w-5 mr-1 text-gray-400')
        <div>{{ __('Log Out') }}</div>

    </x-jet-dropdown-link>
</form>

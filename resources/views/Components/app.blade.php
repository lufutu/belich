<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('belich.name', 'Laravel') }}</title>

        {{-- Fonts --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        {{-- Css styles --}}
        <link rel="stylesheet" href="{{ asset('css/belich.css') }}">
        @livewireStyles

        {{-- Custom scripts --}}
        <script src="{{ asset('js/belich.js') }}" defer></script>
    </head>
    <body>
        {{-- Container --}}
        <div class="flex bg-gray-100" x-data="{isClose: true, toggle: true}">
            {{-- Sidebar --}}
            <x:belich::sidebar></x:belich::sidebar>
            {{-- Content --}}
            <div class="flex-1 h-full min-h-screen">
                {{-- Navbar --}}
                <x:belich::navbar></x:belich::navbar>
                {{-- Container --}}
                <x:belich::container></x:belich::container>
            </div>
        </div>
        {{-- Javascript libraries --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    </body>
</html>


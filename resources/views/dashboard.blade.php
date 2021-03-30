<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('belich.name', 'Laravel') }}</title>

        {{-- Fonts --}}
        <link rel="stylesheet" href="//fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        {{-- Css styles --}}
        <link rel="stylesheet" href="@mix('css/belich.css')">

        {{-- Fontawesome --}}
        @if(config('belich.icons') === 'fontawesome')
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css"/>
        @endif

        {{-- Livwire --}}
        @livewireStyles

        {{-- Custom scripts --}}
        <script src="@mix('js/belich.js')" defer></script>

    </head>
    <body>

        {{-- Container --}}
        <div class="flex" x-data="{isClose: true, toggle: true}">

            {{-- Sidebar --}}
            <x-belich-sidebar />

            {{-- Main Container --}}
            <div class="flex-1 h-full min-h-screen">

                {{-- Navbar --}}
                <x-belich-navbar />

                {{-- Container --}}
                <x-belich-container />

            </div>

        </div>

        {{-- Modals --}}
        @stack('modals')

        {{-- Javascript libraries --}}
        @livewireScripts
        <script src="//cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@1.1.x/dist/component.min.js" defer></script>
        <script src="//cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    </body>
</html>


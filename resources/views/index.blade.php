<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nexum - project</title>

        @livewireStyles
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.2/dist/cdn.min.js"></script>

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body>
        <div class="relative sm:flex sm:justify-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <img width="140" height="35" src="storage/images/nexum.svg" alt="Nexum" title="Nexum">
                </div>

                @if (session()->has('message'))
                    <div class="bg-green-500 text-white font-bold p-2 mt-2 rounded-lg text-center">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="mt-4">

                    <livewire:category-list :categories="$categories" />
                    
                </div>

            </div>
        </div>
        
        @livewireScripts

    </body>
</html>

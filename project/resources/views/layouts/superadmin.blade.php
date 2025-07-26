<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Poppins', 'sans-serif'],
                        },
                    },
                },
            }
        </script>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        
    </head>
    <body class="font-sans antialiased">
        <div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100">
            @include('superadmin.partials.sidebar')

            <div class="flex flex-col flex-1">
                @include('superadmin.partials.header')

                <main class="h-full pb-16 overflow-y-auto">
                    <div class="container grid px-6 mx-auto">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700">
                            {{ $title ?? '' }}
                        </h2>
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html> 
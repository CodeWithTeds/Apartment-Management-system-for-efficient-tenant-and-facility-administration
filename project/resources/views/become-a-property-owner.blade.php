<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hyslop | Become a Property Owner</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <x-header />

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div class="hidden md:block">
                <img src="{{ asset('images/become-owner.png') }}" alt="A modern apartment building" class="rounded-2xl shadow-lg w-full h-full object-cover">
            </div>
            <div class="max-w-4xl mx-auto">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Partner with Hyslop</h1>
                    <p class="text-lg text-gray-600 mb-8">Join our network of property owners and unlock the full potential of your investment. Start by verifying your email address.</p>
                    
                    @livewire('property-application-form')
                </div>
            </div>
        </div>
    </main>

    <x-footer />
</body>
</html> 
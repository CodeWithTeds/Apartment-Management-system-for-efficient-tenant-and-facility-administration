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
<body class="bg-gray-50" x-data="{ step: 'email', verificationCode: '', email: '' }">
    <x-header />

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div class="hidden md:block">
                <img src="{{ asset('images/become-owner.png') }}" alt="A modern apartment building" class="rounded-2xl shadow-lg w-full h-full object-cover">
            </div>
            <div class="max-w-4xl mx-auto">
                <div x-show="step === 'email'">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Partner with Hyslop</h1>
                    <p class="text-lg text-gray-600 mb-8">Join our network of property owners and unlock the full potential of your investment. Start by verifying your email address.</p>
                    
                    <div class="flex items-center space-x-4">
                        <input type="email" x-model="email" placeholder="Enter your email address" class="flex-grow border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <button @click.prevent="step = 'code'" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Get Code
                        </button>
                    </div>
                </div>

                <div x-show="step === 'code'" x-cloak>
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">Enter Verification Code</h1>
                    <p class="text-lg text-gray-600 mb-8">We've sent a verification code to <span x-text="email" class="font-semibold"></span>. Please enter it below to continue.</p>
                    
                    <x-property-application-form />
                </div>
            </div>
        </div>
    </main>

    <x-footer />
</body>
</html> 
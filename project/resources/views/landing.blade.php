<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hyslop | Apartment Management System</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-50" x-data="{}" x-init="
    let observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-in-up').forEach(el => {
        observer.observe(el);
    });
">
    <x-header />

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center" style="background-image: url('{{ asset('images/hero.png') }}'); height: 443px;">

        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 flex flex-col items-start justify-center h-full max-w-6xl mx-auto text-white px-6">
            <h1 class="text-4xl font-bold uppercase tracking-wider fade-in-up">Hyslop Apartment Management System</h1>
            <p class="mt-4 text-lg max-w-xl fade-in-up" style="animation-delay: 0.2s;">Hyslop helps property managers improve operations, improve tenant satisfaction, and maximize revenue with our all-in-one apartment management system.</p>
        </div>
    </section>

    <main class="py-16">
        
        <!-- Featured Apartments Section -->
        <section id="featured-apartments" class="mb-24 container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-800">Explore Our Premier Apartments</h2>
                <p class="mt-2 text-lg text-gray-600 mx-auto">Handpicked for quality and comfort. Find your next home with Hyslop.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">
                @foreach($apartments as $apartment)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-all duration-300 ease-in-out hover:shadow-2xl fade-in-up">
                        <a href="{{ route('apartment.show', $apartment) }}" class="block">
                            <img src="{{ asset('images/apartments/' . $apartment->image1) }}" alt="{{ $apartment->name }}" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $apartment->name }}</h3>
                                <p class="mt-2 text-gray-600 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                    {{ $apartment->address }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-12 text-center">
                <a href="#" class="inline-block bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-300">
                    View all Apartments
                </a>
            </div>
        </section>

        <!-- Management Sections -->
        <section class="mb-24 container mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-12 text-center">
            <!-- Property Management -->
            <div class="bg-white p-8 rounded-2xl shadow-lg fade-in-up" style="transition-delay: 100ms;">
                <div class="flex justify-center items-center h-20 w-20 mx-auto bg-blue-100 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 4h5m-5 4h5"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Property Management</h3>
                <p class="text-gray-600">Easily manage multiple properties and units with our intuitive dashboard. Track occupancy, rent payments, and maintenance all in one place.</p>
            </div>
            <!-- Tenant Management -->
            <div class="bg-white p-8 rounded-2xl shadow-lg fade-in-up" style="transition-delay: 200ms;">
                <div class="flex justify-center items-center h-20 w-20 mx-auto bg-blue-100 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.284-1.255-.778-1.682M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.284-1.255.778-1.682M12 15a4 4 0 100-8 4 4 0 000 8z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Tenant Management</h3>
                <p class="text-gray-600">Keep track of all tenant information, lease agreements, and communication history. Simplify rent collection and handle tenant requests efficiently.</p>
            </div>
            <!-- Maintenance Request -->
            <div class="bg-white p-8 rounded-2xl shadow-lg fade-in-up" style="transition-delay: 300ms;">
                <div class="flex justify-center items-center h-20 w-20 mx-auto bg-blue-100 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Maintenance Request</h3>
                <p class="text-gray-600">Improve maintenance workflow with digital request submission, tracking, and resolution. Keep both tenants and maintenance staff informed.</p>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-12 text-center">
            <div class="bg-white p-8 rounded-2xl shadow-lg fade-in-up" style="transition-delay: 400ms;">
                <p class="text-gray-500 font-medium">Total Properties</p>
                <p class="text-5xl font-bold text-gray-900 mt-2">45</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg fade-in-up" style="transition-delay: 500ms;">
                <p class="text-gray-500 font-medium">Total Units</p>
                <p class="text-5xl font-bold text-gray-900 mt-2">145</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg fade-in-up" style="transition-delay: 600ms;">
                <p class="text-gray-500 font-medium">Average Occupancy</p>
                <p class="text-5xl font-bold text-gray-900 mt-2">95%</p>
            </div>
        </section>

    </main>

    <x-footer />

</body>
</html> 
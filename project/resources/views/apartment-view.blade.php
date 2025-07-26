<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Viewing - {{ $apartment->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .main-image {
            height: 500px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <x-header />

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back to Listings
            </a>
        </div>

        <div class="lg:grid lg:grid-cols-3 lg:gap-x-12">
            <div class="lg:col-span-2">
                <!-- Image Gallery -->
                <div class="shadow-2xl rounded-2xl overflow-hidden bg-white">
                    <div class="main-image">
                        <img src="{{ asset('images/apartments/' . $apartment->image1) }}" alt="Main view of {{ $apartment->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="grid grid-cols-4 gap-1 p-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($apartment->{'image'.$i})
                                <img src="{{ asset('images/apartments/' . $apartment->{'image'.$i}) }}" alt="Apartment Image {{ $i }}" class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity">
                            @endif
                        @endfor
                    </div>
                </div>

                 <!-- Description -->
                 <div class="mt-12 bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">About {{ $apartment->name }}</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $apartment->description ?? 'No description available.' }}
                    </p>
                </div>
            </div>

            <div class="lg:col-span-1 mt-8 lg:mt-0">
                <div class="sticky top-12">
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <h1 class="text-4xl font-bold text-gray-900">{{ $apartment->name }}</h1>
                        <p class="mt-2 text-gray-600 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            {{ $apartment->address }}
                        </p>
                        
                        <div class="mt-6 border-t border-gray-200 pt-6">
                            <dl class="grid grid-cols-2 gap-y-4 gap-x-6">
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500">Total Units</dt>
                                    <dd class="text-lg font-semibold text-gray-800">{{ $apartment->total_units }}</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500">Available</dt>
                                    <dd class="text-lg font-semibold text-gray-800">{{ $apartment->available_units }}</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500">Rent Type</dt>
                                    <dd class="text-lg font-semibold text-gray-800">{{ $apartment->rent_type }}</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500">Pet Policy</dt>
                                    <dd class="text-lg font-semibold text-gray-800">{{ $apartment->pet_policy }}</dd>
                                </div>
                                <div class="flex flex-col col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Capacity per Unit</dt>
                                    <dd class="text-lg font-semibold text-gray-800">{{ $apartment->capacity }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>
</html> 
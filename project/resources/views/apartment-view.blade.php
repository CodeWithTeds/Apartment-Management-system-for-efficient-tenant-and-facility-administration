<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Viewing - {{ $apartment->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .main-image {
            height: 500px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <x-header />

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <a href="/" class="inline-flex items-center text-gray-700 hover:text-gray-900 font-medium transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Listings
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl p-8 lg:p-12">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12">
                
                <!-- Inquiry Form -->
                <div class="lg:col-span-5 mb-12 lg:mb-0">
                    <div class="sticky top-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Send Inquiry</h2>

                        @if(session('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                                <p class="font-bold">Success</p>
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="full_name" id="full_name" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="mobile_no" class="block text-sm font-medium text-gray-700">Mobile No.</label>
                                <input type="text" name="mobile_no" id="mobile_no" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <!-- Type of Stay -->
                            <fieldset class="mt-6">
                                <legend class="text-sm font-medium text-gray-900">Type of Stay</legend>
                                <div class="mt-4 space-y-4">
                                    <div class="flex items-center">
                                        <input id="monthly" name="stay_type" type="radio" value="monthly" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                        <label for="monthly" class="ml-3 block text-sm font-medium text-gray-700">Monthly</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="short_term" name="stay_type" type="radio" value="short_term" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" checked>
                                        <label for="short_term" class="ml-3 block text-sm font-medium text-gray-700">Short Term (min. {{ $apartment->short_term_minimum_stay ?? 3 }} nights)</label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="flex items-center space-x-4">
                                <div>
                                    <label for="nights" class="block text-sm font-medium text-gray-700">If short term, how many nights</label>
                                    <input type="number" name="nights" id="nights" min="1" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="occupants" class="block text-sm font-medium text-gray-700">Number of Occupants (max. 5)</label>
                                    <input type="number" name="occupants" id="occupants" min="1" max="5" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Message (Optional)</label>
                                <textarea name="message" id="message" rows="4" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <div class="mt-6">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="terms" name="terms" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="terms" class="font-medium text-gray-700">I have read and agree to the <a href="#" class="text-blue-600 hover:text-blue-500">Terms and Conditions</a></label>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Apartment Details -->
                <div class="lg:col-span-7">
                    <h1 class="text-5xl font-extrabold text-gray-900">{{ $apartment->name }}</h1>
                    <p class="mt-2 text-gray-600 flex items-center text-lg">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-500"></i>
                        {{ $apartment->address }}
                    </p>
                    
                    <!-- Image Gallery -->
                    <div class="mt-8">
                        <div class="main-image shadow-2xl rounded-2xl overflow-hidden">
                            <img src="{{ asset('images/apartments/' . $apartment->image1) }}" alt="Main view of {{ $apartment->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="grid grid-cols-5 gap-2 mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($apartment->{'image'.$i})
                                    <img src="{{ asset('images/apartments/' . $apartment->{'image'.$i}) }}" alt="Apartment Image {{ $i }}" class="w-full h-28 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity shadow-lg">
                                @endif
                            @endfor
                        </div>
                    </div>

                    <!-- Stay Options -->
                    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                        @if($apartment->monthly_price)
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl shadow-lg">
                            <h3 class="text-3xl font-bold text-blue-900 mb-4">Monthly Stay</h3>
                            <p class="text-4xl font-bold text-blue-800">P{{ number_format($apartment->monthly_price, 2) }} <span class="text-xl font-medium text-gray-600">per month</span></p>
                            <div class="mt-6">
                                <h4 class="font-bold text-lg text-gray-800">What's Included:</h4>
                                <div class="prose text-gray-700 mt-2">
                                    {!! nl2br(e($apartment->monthly_includes)) !!}
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($apartment->short_term_price)
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl shadow-lg">
                            <h3 class="text-3xl font-bold text-green-900 mb-4">Short-Term Stay</h3>
                            <p class="text-4xl font-bold text-green-800">P{{ number_format($apartment->short_term_price, 2) }} <span class="text-xl font-medium text-gray-600">per night</span></p>
                            @if($apartment->short_term_minimum_stay)
                            <p class="text-md text-gray-600 mt-2">Minimum stay: {{ $apartment->short_term_minimum_stay }} nights</p>
                            @endif
                            <div class="mt-6">
                                <h4 class="font-bold text-lg text-gray-800">What's Included:</h4>
                                <div class="prose text-gray-700 mt-2">
                                    {!! nl2br(e($apartment->short_term_includes)) !!}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
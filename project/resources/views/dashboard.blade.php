<x-admin-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs">
        <h2 class="text-lg font-semibold text-gray-800">Welcome, {{ auth()->user()->name }}</h2>
        <p class="mt-2 text-gray-600">This is your dashboard. You can manage your properties here.</p>
    </div>

    @if(session('success'))
        <div class="p-4 mt-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 mt-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($hasPendingPayment)
    <div class="mb-4 rounded-md bg-yellow-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">Attention needed</h3>
                <div class="mt-2 text-sm text-yellow-700">
                    <p>Your subscription payment is pending. Please pay now to continue accessing the system.</p>
                </div>
                <div class="mt-4">
                    <div class="-mx-2 -my-1.5 flex">
                        <a href="{{ auth()->user()->subscription->payment_link }}" type="button" class="rounded-md bg-yellow-50 px-2 py-1.5 text-sm font-medium text-yellow-800 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-offset-2 focus:ring-offset-yellow-50">Pay Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($properties->isNotEmpty())
        @foreach($properties as $property)
            <div class="bg-white rounded-2xl shadow-xl mt-6">
                <div class="p-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900">{{ $property->name }}</h1>
                            <p class="mt-2 text-gray-600 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                {{ $property->address }}
                            </p>
                        </div>
                        @if(!$hasPendingPayment)
                            <a href="{{ route('admin.property.edit', $property) }}" class="px-6 py-3 text-sm font-bold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition-all duration-200">Edit Property</a>
                        @else
                            <button disabled class="px-6 py-3 text-sm font-bold text-white bg-gray-400 rounded-lg shadow-md cursor-not-allowed">Edit Property</button>
                        @endif
                    </div>

                                        <div class="mt-6">
                        @if($property->image1)
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <img src="{{ asset('images/apartments/' . $property->image1) }}" alt="Apartment Image" class="w-full h-full object-cover rounded-xl shadow-lg aspect-[4/3]">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                @if($property->image2)
                                    <img src="{{ asset('images/apartments/' . $property->image2) }}" alt="Apartment Image" class="w-full h-full object-cover rounded-xl shadow-lg aspect-square">
                                @endif
                                @if($property->image3)
                                    <img src="{{ asset('images/apartments/' . $property->image3) }}" alt="Apartment Image" class="w-full h-full object-cover rounded-xl shadow-lg aspect-square">
                                @endif
                                @if($property->image4)
                                    <img src="{{ asset('images/apartments/' . $property->image4) }}" alt="Apartment Image" class="w-full h-full object-cover rounded-xl shadow-lg aspect-square">
                                @endif
                                @if($property->image5)
                                    <img src="{{ asset('images/apartments/' . $property->image5) }}" alt="Apartment Image" class="w-full h-full object-cover rounded-xl shadow-lg aspect-square">
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-8 text-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500">TOTAL UNITS</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $property->total_units }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">AVAILABLE</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $property->available_units }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">RENT TYPE</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $property->rent_type }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">PET POLICY</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $property->pet_policy }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">CAPACITY</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $property->capacity }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">Description</h2>
                            <p class="text-gray-700 leading-relaxed prose">
                                {{ $property->description }}
                            </p>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">Apartment Rules</h2>
                            @if($property->rules->isNotEmpty())
                                <ul class="list-disc list-inside text-gray-700 space-y-2">
                                    @foreach($property->rules as $rule)
                                        <li>{{ $rule->rule }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">No rules specified for this property.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl shadow-lg">
                            <h2 class="text-3xl font-bold text-blue-900 mb-4">Monthly Stay</h2>
                            <p class="text-4xl font-bold text-blue-800">P{{ number_format($property->monthly_price ?? 0, 2) }} <span class="text-xl font-medium text-gray-600">per month</span></p>
                            <div class="mt-6">
                                <h3 class="font-bold text-lg text-gray-800">What's Included:</h3>
                                <div class="prose text-gray-700 mt-2">
                                    {!! nl2br(e($property->monthly_includes ?? 'Not specified')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl shadow-lg">
                            <h2 class="text-3xl font-bold text-green-900 mb-4">Short-Term Stay</h2>
                            <p class="text-4xl font-bold text-green-800">P{{ number_format($property->short_term_price ?? 0, 2) }} <span class="text-xl font-medium text-gray-600">per night</span></p>
                            @if($property->short_term_minimum_stay)
                            <p class="text-md text-gray-600 mt-2">Minimum stay: {{ $property->short_term_minimum_stay }} nights</p>
                            @endif
                            <div class="mt-6">
                                <h3 class="font-bold text-lg text-gray-800">What's Included:</h3>
                                <div class="prose text-gray-700 mt-2">
                                    {!! nl2br(e($property->short_term_includes ?? 'Not specified')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    @else
        <div class="bg-white rounded-lg shadow-lg mt-6">
            <div class="p-8 text-center">
                <p class="text-gray-600">You have no properties assigned to you yet.</p>
            </div>
        </div>
    @endif
</x-admin-layout>

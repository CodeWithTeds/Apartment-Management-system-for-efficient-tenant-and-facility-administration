<x-admin-layout>
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
            <div class="bg-white rounded-lg shadow-lg mt-4">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $property->name }}</h1>
                    <p class="mt-2 text-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        {{ $property->address }}
                    </p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            @if($property->image1)
                                <img src="{{ asset('images/apartments/' . $property->image1) }}" alt="Apartment Image" class="w-full h-96 object-cover rounded-lg">
                            @endif
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            @if($property->image2)
                                <img src="{{ asset('images/apartments/' . $property->image2) }}" alt="Apartment Image" class="w-full h-48 object-cover rounded-lg">
                            @endif
                            @if($property->image3)
                                <img src="{{ asset('images/apartments/' . $property->image3) }}" alt="Apartment Image" class="w-full h-48 object-cover rounded-lg">
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center">
                            <div>
                                <p class="text-sm text-gray-500">TOTAL UNITS</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $property->total_units }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">AVAILABLE UNIT</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $property->available_units }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">RENT TYPE</p>
                                <p class="font-semibold text-gray-800">{{ $property->rent_type }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">PET POLICY</p>
                                <p class="font-semibold text-gray-800">{{ $property->pet_policy }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Capacity per unit</p>
                                <p class="font-semibold text-gray-800">{{ $property->capacity }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Description</h2>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $property->description }}
                            </p>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Apartment Rules</h2>
                            @if($property->rules->isNotEmpty())
                                <ul class="list-disc list-inside text-gray-700 space-y-1">
                                    @foreach($property->rules as $rule)
                                        <li>{{ $rule->rule }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-700">No rules specified for this property.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="bg-white rounded-lg shadow-lg mt-4">
            <div class="p-6 text-center">
                <p class="text-gray-500">You have no properties assigned to you yet.</p>
            </div>
        </div>
    @endif
</x-admin-layout>

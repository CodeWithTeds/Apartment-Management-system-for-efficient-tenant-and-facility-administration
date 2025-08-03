<x-superadmin-layout>
    <div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-200">


        <div class="flex flex-col flex-1">

            <main class="flex-1 p-6">
                <h1 class="mb-6 text-3xl font-bold text-gray-800">Property Details</h1>

                <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <div class="p-6 md:col-span-2">
                            <h2 class="mb-4 text-2xl font-semibold text-gray-900">{{ $apartment->name }}</h2>
                            <p class="mb-4 text-gray-600">{{ $apartment->address }}</p>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Total Units</h3>
                                    <p class="text-gray-700">{{ $apartment->total_units }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Available Units</h3>
                                    <p class="text-gray-700">{{ $apartment->available_units }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Capacity</h3>
                                    <p class="text-gray-700">{{ $apartment->capacity }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Rent Type</h3>
                                    <p class="text-gray-700">{{ $apartment->rent_type }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Pet Policy</h3>
                                    <p class="text-gray-700">{{ $apartment->pet_policy }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Price</h3>
                                    <p class="text-2xl font-bold text-indigo-600">
                                        ₱{{ number_format($apartment->price, 2) }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Property Type</h3>
                                    <p class="text-gray-700">{{ $apartment->property_type }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Admin</h3>
                                    <p class="text-gray-700">{{ $apartment->owner->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-800">Description</h3>
                                <p class="mt-2 text-gray-700">{{ $apartment->description }}</p>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-800">Amenities</h3>
                                <p class="mt-2 text-gray-700">{{ $apartment->amenities }}</p>
                            </div>
                        </div>

                        @if ($apartment->image)
                            <div class="p-6">
                                <h3 class="mb-4 text-lg font-semibold text-gray-800">Property Image</h3>
                                <img src="{{ asset('images/apartments/' . $apartment->image) }}"
                                    alt="{{ $apartment->name }}"
                                    class="object-cover w-full h-auto rounded-lg shadow-md">
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-superadmin-layout>

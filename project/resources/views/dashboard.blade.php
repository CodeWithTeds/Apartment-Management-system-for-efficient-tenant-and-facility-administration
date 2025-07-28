<x-admin-layout>
    <x-slot name="title">
        Apartment
    </x-slot>

    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800">Skyline Residences</h1>
            <p class="mt-2 text-gray-600 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                147 San Miguel Street, nabua, Camarines Sur
            </p>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <img src="{{ asset('images/apartments/1753442920_pexels-pixabay-258154.jpg') }}" alt="Apartment Image" class="w-full h-full object-cover rounded-lg">
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <img src="{{ asset('images/apartments/1753442920_pexels-pixabay-258154.jpg') }}" alt="Apartment Image" class="w-full h-auto object-cover rounded-lg">
                    <img src="{{ asset('images/apartments/1753442920_pexels-pixabay-258154.jpg') }}" alt="Apartment Image" class="w-full h-auto object-cover rounded-lg">
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-6">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center">
                    <div>
                        <p class="text-sm text-gray-500">TOTAL UNITS</p>
                        <p class="text-2xl font-bold text-gray-800">15</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">AVAILABLE UNIT</p>
                        <p class="text-2xl font-bold text-gray-800">5</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">RENT TYPE</p>
                        <p class="font-semibold text-gray-800">Long/Short Term</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">PET POLICY</p>
                        <p class="font-semibold text-gray-800">Allowed</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Capacity per unit</p>
                        <p class="font-semibold text-gray-800">2-4 Person</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Description</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Skyline Residences offers practical and comfortable living in the heart of Nabua, Camarines Sur. Ideal for individuals, couples, or small families, the apartment provides a quiet and convenient place to call home.
                    </p>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Apartment Rules</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>No smoking inside the unit</li>
                        <li>No loud noise after 10:00 PM</li>
                        <li>Maximum 5 people per unit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

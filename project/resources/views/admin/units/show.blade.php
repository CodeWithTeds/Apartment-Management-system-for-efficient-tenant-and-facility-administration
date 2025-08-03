<x-admin-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Unit Details</h1>
            <a href="{{ route('admin.units.index') }}" class="px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Back to Units
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $unit->unit_number }}</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Unit Type</p>
                            <p class="text-lg text-gray-800">{{ $unit->unit_type ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Availability</p>
                            @if($unit->availability === 'Available')
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    Available
                                </span>
                            @elseif($unit->availability === 'Occupied')
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Occupied
                                </span>
                            @else
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                    Maintenance
                                </span>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Rent Price</p>
                            <p class="text-lg text-gray-800 font-bold">P{{ number_format($unit->rent_price, 2) }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Description</h3>
                    <div class="prose text-gray-700">
                        {!! nl2br(e($unit->description ?? 'No description provided.')) !!}
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-6 flex justify-end space-x-4">
                <a href="{{ route('admin.units.edit', $unit) }}" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Edit Unit
                </a>
                <form action="{{ route('admin.units.destroy', $unit) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this unit?')">
                        Delete Unit
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
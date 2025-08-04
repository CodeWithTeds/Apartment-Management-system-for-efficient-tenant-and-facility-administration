<x-admin-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Edit Unit</h1>
            <a href="{{ route('admin.units.index') }}" class="px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Back to Units
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.units.update', $unit) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="unit_number" class="block text-sm font-medium text-gray-700 mb-1">Unit Number <span class="text-red-500">*</span></label>
                        <input type="text" name="unit_number" id="unit_number" value="{{ old('unit_number', $unit->unit_number) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('unit_number') border-red-500 @enderror" required>
                        @error('unit_number')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_type" class="block text-sm font-medium text-gray-700 mb-1">Unit Type</label>
                        <select name="unit_type" id="unit_type" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Type</option>
                            <option value="Studio" {{ old('unit_type', $unit->unit_type) === 'Studio' ? 'selected' : '' }}>Studio</option>
                            <option value="1 Bedroom" {{ old('unit_type', $unit->unit_type) === '1 Bedroom' ? 'selected' : '' }}>1 Bedroom</option>
                            <option value="2 Bedroom" {{ old('unit_type', $unit->unit_type) === '2 Bedroom' ? 'selected' : '' }}>2 Bedroom</option>
                            <option value="3 Bedroom" {{ old('unit_type', $unit->unit_type) === '3 Bedroom' ? 'selected' : '' }}>3 Bedroom</option>
                            <option value="Penthouse" {{ old('unit_type', $unit->unit_type) === 'Penthouse' ? 'selected' : '' }}>Penthouse</option>
                        </select>
                        @error('unit_type')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="availability" class="block text-sm font-medium text-gray-700 mb-1">Availability <span class="text-red-500">*</span></label>
                        <select name="availability" id="availability" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('availability') border-red-500 @enderror" required>
                            <option value="Available" {{ old('availability', $unit->availability) === 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Occupied" {{ old('availability', $unit->availability) === 'Occupied' ? 'selected' : '' }}>Occupied</option>
                            <option value="Maintenance" {{ old('availability', $unit->availability) === 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                        @error('availability')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rent_price" class="block text-sm font-medium text-gray-700 mb-1">Rent Price <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">P</span>
                            </div>
                            <input type="number" name="rent_price" id="rent_price" value="{{ old('rent_price', $unit->rent_price) }}" step="0.01" min="0" class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('rent_price') border-red-500 @enderror" required>
                        </div>
                        @error('rent_price')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $unit->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="inquiry_id" class="block text-sm font-medium text-gray-700 mb-1">Assign Tenant</label>
                    <select name="inquiry_id" id="inquiry_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Tenant</option>
                        @foreach ($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ old('inquiry_id', $unit->inquiry_id) == $tenant->id ? 'selected' : '' }}>
                                {{ $tenant->full_name }} ({{ $tenant->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update Unit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
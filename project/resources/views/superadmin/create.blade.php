<x-superadmin-layout>
    <div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-50">
        @include('superadmin.partials.sidebar')
        <div class="flex flex-col flex-1">
            <header class="flex items-center justify-between h-20 px-6 bg-white shadow-md">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </header>
            <main class="flex-1 p-6">
                <h2 class="mb-6 text-3xl font-bold">ADD PROPERTY</h2>
                <div class="p-6 bg-white rounded-lg shadow-lg">
                    <form action="{{ route('superadmin.property.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Apartment
                                    Name</label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('name') border-red-500 @enderror"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" id="address"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('address') border-red-500 @enderror"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="total_units" class="block text-sm font-medium text-gray-700">Total
                                    Units</label>
                                <input type="number" name="total_units" id="total_units"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('total_units') border-red-500 @enderror"
                                    value="{{ old('total_units') }}">
                                @error('total_units')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="available_units" class="block text-sm font-medium text-gray-700">Available
                                    Units</label>
                                <input type="number" name="available_units" id="available_units"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('available_units') border-red-500 @enderror"
                                    value="{{ old('available_units') }}">
                                @error('available_units')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                                <input type="text" name="capacity" id="capacity"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('capacity') border-red-500 @enderror"
                                    value="{{ old('capacity') }}">
                                @error('capacity')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="rent_type" class="block text-sm font-medium text-gray-700">Rent Type</label>
                                <select name="rent_type" id="rent_type"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('rent_type') border-red-500 @enderror">
                                    <option value="Monthly" {{ old('rent_type') == 'Monthly' ? 'selected' : '' }}>
                                        Monthly</option>
                                    <option value="Daily" {{ old('rent_type') == 'Daily' ? 'selected' : '' }}>Daily
                                    </option>
                                </select>
                                @error('rent_type')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="pet_policy" class="block text-sm font-medium text-gray-700">Pet
                                    Policy</label>
                                <select name="pet_policy" id="pet_policy"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('pet_policy') border-red-500 @enderror">
                                    <option value="Allowed" {{ old('pet_policy') == 'Allowed' ? 'selected' : '' }}>
                                        Allowed</option>
                                    <option value="Not Allowed"
                                        {{ old('pet_policy') == 'Not Allowed' ? 'selected' : '' }}>Not Allowed</option>
                                </select>
                                @error('pet_policy')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="text" name="price" id="price"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('price') border-red-500 @enderror"
                                    value="{{ old('price') }}">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="lg:col-span-2">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="image1" class="block text-sm font-medium text-gray-700">Image 1</label>
                                <input type="file" name="image1" id="image1"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('image1') border-red-500 @enderror">
                                @error('image1')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="image2" class="block text-sm font-medium text-gray-700">Image 2</label>
                                <input type="file" name="image2" id="image2"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('image2') border-red-500 @enderror">
                                @error('image2')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="image3" class="block text-sm font-medium text-gray-700">Image 3</label>
                                <input type="file" name="image3" id="image3"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('image3') border-red-500 @enderror">
                                @error('image3')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="image4" class="block text-sm font-medium text-gray-700">Image 4</label>
                                <input type="file" name="image4" id="image4"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('image4') border-red-500 @enderror">
                                @error('image4')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="image5" class="block text-sm font-medium text-gray-700">Image 5</label>
                                <input type="file" name="image5" id="image5"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('image5') border-red-500 @enderror">
                                @error('image5')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="property_type" class="block text-sm font-medium text-gray-700">Property
                                    Type</label>
                                <select name="property_type" id="property_type"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('property_type') border-red-500 @enderror">
                                    <option value="Apartment"
                                        {{ old('property_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="House" {{ old('property_type') == 'House' ? 'selected' : '' }}>
                                        House</option>
                                    <option value="Condo" {{ old('property_type') == 'Condo' ? 'selected' : '' }}>
                                        Condo</option>
                                </select>
                                @error('property_type')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="lg:col-span-2">
                                <label for="amenities"
                                    class="block text-sm font-medium text-gray-700">Amenities</label>
                                <textarea name="amenities" id="amenities" rows="4"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('amenities') border-red-500 @enderror">{{ old('amenities') }}</textarea>
                                @error('amenities')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="admin_id" class="block text-sm font-medium text-gray-700">Admin</label>
                                <select name="admin_id" id="admin_id"
                                    class="w-full px-3 py-2 mt-1 border rounded-md @error('admin_id') border-red-500 @enderror">
                                    @foreach ($admins as $admin)
                                        <option value="{{ $admin->id }}"
                                            {{ old('admin_id') == $admin->id ? 'selected' : '' }}>{{ $admin->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('admin_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900">Apartment Rules</h3>
                            <div id="rules-container" class="mt-2">
                                <div class="flex items-center mt-2">
                                    <input type="text" name="rules[]" class="w-full px-3 py-2 border rounded-md" placeholder="Enter a rule">
                                    <button type="button" class="ml-2 text-red-500" onclick="removeRule(this)">Remove</button>
                                </div>
                            </div>
                            <button type="button" id="add-rule" class="mt-2 text-blue-500">Add Rule</button>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="px-6 py-2 font-semibold text-white bg-blue-600 rounded-lg">
                                SAVE PROPERTY
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.getElementById('add-rule').addEventListener('click', function () {
            const rulesContainer = document.getElementById('rules-container');
            const newRule = document.createElement('div');
            newRule.className = 'flex items-center mt-2';
            newRule.innerHTML = `
                <input type="text" name="rules[]" class="w-full px-3 py-2 border rounded-md" placeholder="Enter a rule">
                <button type="button" class="ml-2 text-red-500" onclick="removeRule(this)">Remove</button>
            `;
            rulesContainer.appendChild(newRule);
        });

        function removeRule(button) {
            button.parentElement.remove();
        }
    </script>
</x-superadmin-layout>

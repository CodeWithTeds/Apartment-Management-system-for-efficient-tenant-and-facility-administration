<x-superadmin-layout>
    <div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-50">
        @include('superadmin.partials.sidebar')
        <div class="flex flex-col flex-1">
            <header class="flex items-center justify-between h-20 px-6 bg-white shadow-md">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </header>
            <main class="flex-1 p-6">
                <h2 class="mb-6 text-3xl font-bold">ADD PROPERTY</h2>
                <div class="p-6 bg-white rounded-lg shadow-lg">
                    <form action="{{ route('superadmin.property.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Apartment Name</label>
                                <input type="text" name="name" id="name" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" id="address" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                            <div>
                                <label for="total_units" class="block text-sm font-medium text-gray-700">Total Units</label>
                                <input type="number" name="total_units" id="total_units" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                            <div>
                                <label for="available_units" class="block text-sm font-medium text-gray-700">Available Units</label>
                                <input type="number" name="available_units" id="available_units" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                                <input type="text" name="capacity" id="capacity" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                            <div>
                                <label for="rent_type" class="block text-sm font-medium text-gray-700">Rent Type</label>
                                <select name="rent_type" id="rent_type" class="w-full px-3 py-2 mt-1 border rounded-md">
                                    <option value="Monthly">Monthly</option>
                                    <option value="Daily">Daily</option>
                                </select>
                            </div>
                            <div>
                                <label for="pet_policy" class="block text-sm font-medium text-gray-700">Pet Policy</label>
                                <select name="pet_policy" id="pet_policy" class="w-full px-3 py-2 mt-1 border rounded-md">
                                    <option value="Allowed">Allowed</option>
                                    <option value="Not Allowed">Not Allowed</option>
                                </select>
                            </div>
                             <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="text" name="price" id="price" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                            <div class="lg:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 mt-1 border rounded-md"></textarea>
                            </div>
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" name="image" id="image" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                            <div>
                                <label for="property_type" class="block text-sm font-medium text-gray-700">Property Type</label>
                                <select name="property_type" id="property_type" class="w-full px-3 py-2 mt-1 border rounded-md">
                                    <option value="Apartment">Apartment</option>
                                    <option value="House">House</option>
                                    <option value="Condo">Condo</option>
                                </select>
                            </div>
                            <div class="lg:col-span-2">
                                <label for="amenities" class="block text-sm font-medium text-gray-700">Amenities</label>
                                <textarea name="amenities" id="amenities" rows="4" class="w-full px-3 py-2 mt-1 border rounded-md"></textarea>
                            </div>
                             <div>
                                <label for="admin_id" class="block text-sm font-medium text-gray-700">Admin</label>
                                <select name="admin_id" id="admin_id" class="w-full px-3 py-2 mt-1 border rounded-md">
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
</x-superadmin-layout> 
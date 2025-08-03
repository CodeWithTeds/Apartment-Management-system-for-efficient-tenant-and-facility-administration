<x-superadmin-layout>
    <div class="flex bg-gray-50">
        <div class="flex flex-col flex-1">
            <main class="flex-1 p-6">
                <h1 class="text-3xl font-bold">SuperAdmin (APARTMENT)</h1>
                <div class="p-8 mt-6 bg-white rounded-lg shadow-lg">
                    <form action="{{ route('superadmin.property.update', $apartment) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Hidden price field with a default value -->
                        <input type="hidden" name="price" value="{{ old('price', $apartment->price ?? 0) }}">
                        
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold">APARTMENT</h2>
                            <div class="p-4 mt-2 border-2 border-gray-300 rounded-md">
                                <label for="name" class="sr-only">Apartment Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $apartment->name) }}" class="w-full text-4xl font-bold border-0 focus:ring-0" placeholder="Apartment Name">
                                <label for="address" class="sr-only">Address</label>
                                <input type="text" name="address" id="address" value="{{ old('address', $apartment->address) }}" class="w-full mt-1 text-gray-500 border-0 focus:ring-0" placeholder="Address">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="relative">
                                    <label for="image{{ $i }}" class="block text-sm font-medium text-gray-700">Image {{ $i }}</label>
                                    <input type="file" name="image{{ $i }}" id="image{{ $i }}" class="w-full px-3 py-2 mt-1 border rounded-md">
                                    @if ($apartment->{'image'.$i})
                                        <img src="{{ asset('images/apartments/' . $apartment->{'image'.$i}) }}" class="object-cover w-full h-48 mt-2 rounded-md">
                                    @endif
                                </div>
                            @endfor
                        </div>

                        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-5">
                            <div>
                                <label for="total_units" class="block text-sm font-medium text-gray-700">TOTAL UNITS</label>
                                <input type="number" name="total_units" id="total_units" value="{{ old('total_units', $apartment->total_units) }}" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                            <div>
                                <label for="available_units" class="block text-sm font-medium text-gray-700">AVAILABLE UNIT</label>
                                <input type="number" name="available_units" id="available_units" value="{{ old('available_units', $apartment->available_units) }}" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                            <div>
                                <label for="rent_type" class="block text-sm font-medium text-gray-700">RENT TYPE</label>
                                <select name="rent_type" id="rent_type" class="w-full px-3 py-2 mt-1 border rounded-md">
                                    <option value="Long/Short Term" @if(old('rent_type', $apartment->rent_type) == 'Long/Short Term') selected @endif>Long/Short Term</option>
                                    <option value="Long Term" @if(old('rent_type', $apartment->rent_type) == 'Long Term') selected @endif>Long Term</option>
                                    <option value="Short Term" @if(old('rent_type', $apartment->rent_type) == 'Short Term') selected @endif>Short Term</option>
                                </select>
                            </div>
                            <div>
                                <label for="pet_policy" class="block text-sm font-medium text-gray-700">PET POLICY</label>
                                <select name="pet_policy" id="pet_policy" class="w-full px-3 py-2 mt-1 border rounded-md">
                                    <option value="Allowed" @if(old('pet_policy', $apartment->pet_policy) == 'Allowed') selected @endif>Allowed</option>
                                    <option value="Not Allowed" @if(old('pet_policy', $apartment->pet_policy) == 'Not Allowed') selected @endif>Not Allowed</option>
                                </select>
                            </div>
                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity per unit</label>
                                <input type="text" name="capacity" id="capacity" value="{{ old('capacity', $apartment->capacity) }}" class="w-full px-3 py-2 mt-1 border rounded-md">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="5" class="w-full p-4 border rounded-md">{{ old('description', $apartment->description) }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label for="property_type" class="block text-sm font-medium text-gray-700">Property Type</label>
                            <select name="property_type" id="property_type" class="w-full px-3 py-2 mt-1 border rounded-md">
                                <option value="Apartment" @if(old('property_type', $apartment->property_type) == 'Apartment') selected @endif>Apartment</option>
                                <option value="House" @if(old('property_type', $apartment->property_type) == 'House') selected @endif>House</option>
                                <option value="Condo" @if(old('property_type', $apartment->property_type) == 'Condo') selected @endif>Condo</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="amenities" class="block text-sm font-medium text-gray-700">Amenities</label>
                            <textarea name="amenities" id="amenities" rows="3" class="w-full p-4 border rounded-md">{{ old('amenities', $apartment->amenities) }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label for="admin_id" class="block text-sm font-medium text-gray-700">Assign to Admin</label>
                            <select name="admin_id" id="admin_id" class="w-full px-3 py-2 mt-1 border rounded-md">
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}" @if(old('admin_id', $apartment->admin_id) == $admin->id) selected @endif>{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="p-6 mb-6 border-2 border-gray-300 rounded-md">
                            <h3 class="mb-4 text-lg font-bold">Apartment Rules</h3>
                            <div id="rules-container">
                                @foreach($apartment->rules as $rule)
                                <div class="flex items-center mt-2">
                                    <input type="text" name="rules[]" class="w-full px-3 py-2 border rounded-md" value="{{ $rule->rule }}">
                                    <button type="button" class="ml-2 text-red-500" onclick="removeRule(this)">Remove</button>
                                </div>
                                @endforeach
                            </div>
                            <div class="flex items-center mt-4">
                                <input type="text" id="new-rule" class="w-full px-3 py-2 border rounded-md" placeholder="Add Rules (max. 7)">
                                <button type="button" id="add-rule" class="px-4 py-2 ml-2 text-white bg-green-500 rounded-md">ADD</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                            <div class="p-6 border-2 border-blue-400 rounded-md">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-2xl font-bold">Monthly Stay</h3>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <input type="number" name="monthly_price" value="{{ old('monthly_price', $apartment->monthly_price) }}" class="text-3xl font-bold border-0 focus:ring-0" placeholder="4500">
                                    <span class="text-gray-500">per month</span>
                                    <p class="text-sm text-gray-500">Water and electricity not included</p>
                                </div>
                                <div class="prose">
                                    <label class="block text-sm font-medium text-gray-700">Whats Included:</label>
                                    <textarea name="monthly_includes" rows="5" class="w-full p-2 mt-1 border rounded-md">{{ old('monthly_includes', $apartment->monthly_includes) }}</textarea>
                                </div>
                            </div>
                            <div class="p-6 border-2 border-green-400 rounded-md">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-2xl font-bold">Short-Term Stay</h3>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                    </label>
                                </div>
                                <div class="mb-4">
                                    <input type="number" name="short_term_price" value="{{ old('short_term_price', $apartment->short_term_price) }}" class="text-3xl font-bold border-0 focus:ring-0" placeholder="300">
                                    <span class="text-gray-500">per night</span>
                                    <input type="number" name="short_term_minimum_stay" value="{{ old('short_term_minimum_stay', $apartment->short_term_minimum_stay) }}" class="mt-1 text-sm text-gray-500 border-0 focus:ring-0" placeholder="3">
                                    <p class="text-sm text-gray-500">Water and electricity are already included</p>
                                </div>
                                <div class="prose">
                                    <label class="block text-sm font-medium text-gray-700">Whats Included:</label>
                                    <textarea name="short_term_includes" rows="5" class="w-full p-2 mt-1 border rounded-md">{{ old('short_term_includes', $apartment->short_term_includes) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-8">
                            <button type="submit" class="px-8 py-3 font-bold text-white bg-green-600 rounded-lg shadow-lg hover:bg-green-700">SAVE</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.getElementById('add-rule').addEventListener('click', function() {
            const newRuleInput = document.getElementById('new-rule');
            const ruleText = newRuleInput.value.trim();
            if (ruleText) {
                const rulesContainer = document.getElementById('rules-container');
                const ruleDiv = document.createElement('div');
                ruleDiv.className = 'flex items-center mt-2';
                ruleDiv.innerHTML = `
                    <input type="text" name="rules[]" class="w-full px-3 py-2 border rounded-md" value="${ruleText}">
                    <button type="button" class="ml-2 text-red-500" onclick="removeRule(this)">Remove</button>
                `;
                rulesContainer.appendChild(ruleDiv);
                newRuleInput.value = '';
            }
        });

        function removeRule(button) {
            button.parentElement.remove();
        }
    </script>
</x-superadmin-layout>
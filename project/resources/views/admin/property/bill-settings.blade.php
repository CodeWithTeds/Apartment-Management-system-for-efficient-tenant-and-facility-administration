<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Bill Settings for {{ $apartment->name }}</h1>
                <a href="{{ route('admin.property.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Back to Properties
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('admin.property.bill-settings.update', $apartment) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Bill Type Settings</h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Enable or disable different bill types for this property.
                            </p>
                        </div>

                        <div class="flex flex-col space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h3 class="font-medium text-gray-900">Rent</h3>
                                    <p class="text-sm text-gray-500">Base rent payment (always enabled)</p>
                                </div>
                                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                    Always Enabled
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h3 class="font-medium text-gray-900">Water Bill</h3>
                                    <p class="text-sm text-gray-500">Allow tenants to pay water bills</p>
                                </div>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="water_bill_toggle" value="0">
                                    <input type="checkbox" name="water_bill_toggle" value="1" class="sr-only peer" {{ $apartment->water_bill_toggle ? 'checked' : '' }}>
                                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <h3 class="font-medium text-gray-900">Electric Bill</h3>
                                    <p class="text-sm text-gray-500">Allow tenants to pay electricity bills</p>
                                </div>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="electric_bill_toggle" value="0">
                                    <input type="checkbox" name="electric_bill_toggle" value="1" class="sr-only peer" {{ $apartment->electric_bill_toggle ? 'checked' : '' }}>
                                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Save Bill Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

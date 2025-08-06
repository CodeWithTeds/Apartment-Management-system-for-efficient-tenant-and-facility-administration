<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Create a New Payment</h2>
                <p class="text-gray-600 mb-8">Generate a PayMongo payment link for a tenant.</p>
                <form action="{{ route('admin.payments.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="tenant_id" class="block text-sm font-medium text-gray-700 mb-1">Select Tenant</label>
                            <select id="tenant_id" name="tenant_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach ($tenants as $tenant)
                                    <option value="{{ $tenant->id }}">{{ $tenant->name }} ({{$tenant->email}})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">P</span>
                                </div>
                                <input type="number" name="amount" id="amount" step="0.01" min="0" class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
                            </div>
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Monthly Rent for January"></textarea>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('admin.payments.index') }}" class="px-4 py-2 mr-3 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Generate Payment Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

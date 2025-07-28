<x-superadmin-layout>
    <x-slot name="title">
        Edit Subscription
    </x-slot>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Edit Subscription</h1>
                <a href="{{ route('superadmin.subscriptions.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white rounded-lg shadow-md mt-4">
        <form action="{{ route('superadmin.subscriptions.update', $subscription) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Subscription Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Admin:</span>
                            <p class="text-gray-900">{{ $subscription->user->name }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Billing Email:</span>
                            <p class="text-gray-900">{{ $subscription->billing_email }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Plan:</span>
                            <p class="text-gray-900">{{ ucfirst($subscription->subscription_plan) }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Billing Cycle:</span>
                            <p class="text-gray-900">{{ ucfirst($subscription->billing_cycle) }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Amount:</span>
                            <p class="text-gray-900">₱{{ number_format($subscription->amount, 2) }}</p>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="Active" {{ $subscription->status === 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Suspended" {{ $subscription->status === 'Suspended' ? 'selected' : '' }}>Suspended</option>
                            <option value="Cancelled" {{ $subscription->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Subscription
                </button>
            </div>
        </form>
    </div>
</x-superadmin-layout> 
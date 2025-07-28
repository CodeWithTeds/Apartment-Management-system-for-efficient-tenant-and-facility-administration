<x-superadmin-layout>
    <x-slot name="title">
        Subscription Details
    </x-slot>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Subscription Details</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('superadmin.subscriptions.edit', $subscription) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300">
                        Edit
                    </a>
                    <form action="{{ route('superadmin.subscriptions.destroy', $subscription) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this subscription?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300">
                            Delete
                        </button>
                    </form>
                    <a href="{{ route('superadmin.subscriptions.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white rounded-lg shadow-md mt-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Subscription Information</h2>
                <div class="space-y-3">
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
                </div>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Payment Information</h2>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Amount:</span>
                        <p class="text-gray-900">₱{{ number_format($subscription->amount, 2) }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Start Date:</span>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($subscription->start_date)->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Renewal Date:</span>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($subscription->renewal_date)->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Status:</span>
                        <p class="text-gray-900 flex items-center">
                            <span class="h-2.5 w-2.5 rounded-full {{ $subscription->status === 'Active' ? 'bg-green-400' : ($subscription->status === 'Suspended' ? 'bg-yellow-400' : 'bg-red-400') }} mr-2"></span>
                            {{ $subscription->status }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if($subscription->payment_link)
            <div class="mt-8 border-t border-gray-200 pt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Payment Link</h2>
                <div class="bg-gray-100 p-3 rounded-lg text-sm break-all">
                    {{ $subscription->payment_link }}
                </div>
            </div>
        @endif

        @if(trim($subscription->notes ?? ''))
            <div class="mt-8 border-t border-gray-200 pt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Notes</h2>
                <div class="bg-gray-100 p-4 rounded-lg">
                    {{ $subscription->notes }}
                </div>
            </div>
        @endif
    </div>
</x-superadmin-layout> 
<x-superadmin-layout>
    <x-slot name="title">
        Subscriptions
    </x-slot>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <span class="font-medium">Error!</span> {{ session('error') }}
        </div>
    @endif

    @if (isset($message))
        <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg" role="alert">
            <span class="font-medium">Note:</span> {{ $message }}
        </div>
    @endif

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">All Subscriptions</h1>
                </div>
                <div class="flex items-center space-x-2 mt-3 md:mt-0">
                    <div class="flex items-center space-x-3 overflow-x-auto pb-2">
                        <a href="{{ route('superadmin.subscriptions.index', ['status' => 'Active']) }}" class="px-3 py-2 text-xs font-medium rounded-full {{ request()->get('status') == 'Active' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-700' }} whitespace-nowrap">
                            Active
                        </a>
                        <a href="{{ route('superadmin.subscriptions.index', ['status' => 'Suspended']) }}" class="px-3 py-2 text-xs font-medium rounded-full {{ request()->get('status') == 'Suspended' ? 'bg-yellow-500 text-white' : 'bg-gray-200 text-gray-700' }} whitespace-nowrap">
                            Suspended
                        </a>
                        <a href="{{ route('superadmin.subscriptions.index', ['status' => 'Cancelled']) }}" class="px-3 py-2 text-xs font-medium rounded-full {{ request()->get('status') == 'Cancelled' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700' }} whitespace-nowrap">
                            Cancelled
                        </a>
                        <a href="{{ route('superadmin.subscriptions.index') }}" class="px-3 py-2 text-xs font-medium rounded-full {{ !request()->has('status') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }} whitespace-nowrap">
                            All
                        </a>
                    </div>
                    <a href="{{ route('superadmin.subscriptions.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 whitespace-nowrap">
                        Create Subscription
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Admin
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Plan
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Cycle
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Amount
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Status
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Payment Status
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($subscriptions as $subscription)
                                <tr class="hover:bg-gray-100">
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        <div class="text-base font-semibold text-gray-900">{{ $subscription->user->name }}</div>
                                        <div class="text-sm font-normal text-gray-500">{{ $subscription->billing_email }}</div>
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap">{{ $subscription->subscription_plan }}</td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap">{{ $subscription->billing_cycle }}</td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap">₱{{ number_format($subscription->amount, 2) }}</td>
                                    <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full {{ $subscription->status === 'Active' ? 'bg-green-400' : ($subscription->status === 'Suspended' ? 'bg-yellow-400' : 'bg-red-400') }} mr-2"></div>
                                            {{ $subscription->status }}
                                        </div>
                                    </td>
                                    <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full 
                                                {{ $subscription->payment_status === 'paid' ? 'bg-green-400' : 
                                                   ($subscription->payment_status === 'pending' ? 'bg-yellow-400' : 
                                                   ($subscription->payment_status === 'refunded' ? 'bg-blue-400' : 'bg-red-400')) }} 
                                                mr-2"></div>
                                            {{ ucfirst($subscription->payment_status) }}
                                        </div>
                                    </td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <a href="{{ route('superadmin.subscriptions.show', $subscription) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                            View
                                        </a>
                                        
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4">
        {{ $subscriptions->links() }}
    </div>
</x-superadmin-layout> 
<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Payments</h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.payments.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Payment
                </a>
            </div>
        </div>
        
        <!-- Bill Type Settings -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Bill Type Settings</h2>
            <p class="text-gray-600 mb-4">Enable or disable different bill types for your properties.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse(auth()->user()->properties as $property)
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-medium">{{ $property->name }}</h3>
                            <a href="{{ route('admin.property.bill-settings', $property) }}" class="text-blue-600 hover:text-blue-800 text-sm">Manage</a>
                        </div>
                        <div class="space-y-2 mt-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Rent</span>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Always Enabled</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Water Bill</span>
                                @if($property->water_bill_toggle)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Enabled</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">Disabled</span>
                                @endif
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Electric Bill</span>
                                @if($property->electric_bill_toggle)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Enabled</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">Disabled</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-4 text-gray-500">
                        No properties found. <a href="{{ route('admin.property.create') }}" class="text-blue-600 hover:underline">Add a property</a> to manage bill settings.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6 flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Total Payments</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_payments'] }}</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0 1H9m3 0h3m-3 18a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Total Paid</h2>
                    <p class="text-2xl font-bold text-gray-800">P{{ number_format($stats['total_paid'], 2) }}</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Total Pending</h2>
                    <p class="text-2xl font-bold text-gray-800">P{{ number_format($stats['total_pending'], 2) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenant</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bill Type</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Link</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($payments as $payment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($payment->tenant->name) }}&background=0D8ABC&color=fff" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $payment->tenant->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $payment->tenant->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">P{{ number_format($payment->amount, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">{{ $payment->bill_type ?? 'rent' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($payment->status === 'paid')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if($payment->payment_link)
                                    <a href="{{ $payment->payment_link }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">View Link</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                No payments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>

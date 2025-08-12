<x-tenant-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <div class="flex items-center p-4 bg-blue-500 rounded-lg shadow-xs">
            <div>
                <p class="mb-2 text-sm font-medium text-white">
                    Latest Payment
                </p>
                <p class="text-lg font-semibold text-white">
                    ₱{{ number_format($latestPayment->amount ?? 0, 2) }}
                </p>
                <p class="text-xs text-white">
                    Date: {{ $latestPayment ? $latestPayment->created_at->format('M d, Y') : 'N/A' }}
                </p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Payment Status
                </p>
                @if($latestPayment)
                    @if($latestPayment->status === 'paid')
                        <p class="text-lg font-semibold text-green-600">Paid</p>
                        <p class="text-xs text-gray-500">Last updated: {{ $latestPayment->updated_at->format('M d, Y') }}</p>
                    @elseif($latestPayment->status === 'pending')
                        <p class="text-lg font-semibold text-yellow-600">Pending</p>
                        <p class="text-xs text-gray-500">
                            <a href="{{ $latestPayment->payment_link }}" class="text-blue-500 hover:underline">Complete Payment</a>
                        </p>
                    @else
                        <p class="text-lg font-semibold text-red-600">{{ ucfirst($latestPayment->status) }}</p>
                    @endif
                @else
                    <p class="text-lg font-semibold text-gray-700">No payments</p>
                @endif
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Maintenance Status
                </p>
                <ul>
                    <li class="text-sm text-gray-600">Request 001: <span class="text-yellow-500">In Progress</span></li>
                    <li class="text-sm text-gray-600">Request 002: <span class="text-green-500">Completed</span></li>
                    <li class="text-sm text-gray-600">Request 003: <span class="text-red-500">Pending</span></li>
                </ul>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Total Payments
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    {{ $payments->where('status', 'paid')->count() }}
                </p>
                <p class="text-xs text-gray-500">
                    Total Amount: ₱{{ number_format($payments->where('status', 'paid')->sum('amount'), 2) }}
                </p>
            </div>
        </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Payment History</h2>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Payment Date</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($paymentHistory as $payment)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                {{ $payment->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $payment->description ?: 'Regular Payment' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                ₱{{ number_format($payment->amount, 2) }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                @if($payment->status === 'paid')
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                        Paid
                                    </span>
                                @elseif($payment->status === 'pending')
                                    <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full">
                                        Pending
                                    </span>
                                @else
                                    <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-xs">
                                @if($payment->status === 'pending' && $payment->payment_link)
                                    <a href="{{ $payment->payment_link }}" class="text-blue-600 hover:underline">Complete Payment</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                No payment history found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
                <a href="#" class="text-blue-500 hover:text-blue-700">See All Invoices</a>
            </div>
        </div>
    </div>
</x-tenant-layout>

<x-tenant-layout>
    <x-slot name="title">Payments</x-slot>

    <div class="max-w-5xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
        @endif

        @if($pendingPayment)
            <div class="mb-6 rounded border border-yellow-200 bg-yellow-50 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-yellow-800 font-semibold">Pending Payment</p>
                        <p class="text-sm text-yellow-700">{{ $pendingPayment->description }} — ₱{{ number_format($pendingPayment->amount, 2) }}</p>
                    </div>
                    <a href="{{ $pendingPayment->payment_link }}" class="inline-flex items-center px-4 py-2 rounded bg-yellow-500 text-white hover:bg-yellow-600">Pay now</a>
                </div>
            </div>
        @endif

        <div class="bg-white shadow rounded">
            <div class="px-4 py-3 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Payment history</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-xs uppercase tracking-wide text-gray-500 bg-gray-50">
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Description</th>
                            <th class="px-4 py-3 text-left">Amount</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($payments as $payment)
                            <tr class="text-sm text-gray-700">
                                <td class="px-4 py-3">{{ $payment->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-4 py-3">{{ $payment->description }}</td>
                                <td class="px-4 py-3">₱{{ number_format($payment->amount, 2) }}</td>
                                <td class="px-4 py-3">
                                    @if($payment->status === 'paid')
                                        <span class="px-2 py-1 rounded-full bg-green-100 text-green-700">Paid</span>
                                    @elseif($payment->status === 'pending')
                                        <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full bg-red-100 text-red-700">{{ ucfirst($payment->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($payment->status === 'pending' && $payment->payment_link)
                                        <a href="{{ $payment->payment_link }}" class="text-blue-600 hover:underline">Complete payment</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">No payments yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-tenant-layout>



<x-tenant-layout>
    <x-slot name="title">Payments</x-slot>

    <div class="max-w-screen-2xl mx-auto px-6 md:px-10 py-8">
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

        <div class="bg-white shadow-xl rounded-xl border border-gray-100">
            <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white rounded-t-xl">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Payment history</h2>
                    <a href="{{ route('tenant.agreements.index') }}" class="text-blue-600 hover:underline">View my lease agreements</a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-[900px] w-full">
                    <thead class="sticky top-0 z-10">
                        <tr class="text-xs uppercase tracking-wide text-gray-600 bg-gray-50/80 backdrop-blur">
                            <th class="px-6 py-3 text-left">Date</th>
                            <th class="px-6 py-3 text-left">Description</th>
                            <th class="px-6 py-3 text-left">Amount</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($payments as $payment)
                            <tr class="text-sm text-gray-700 odd:bg-white even:bg-gray-50 hover:bg-blue-50/60 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">{{ $payment->description }}</td>
                                <td class="px-6 py-4 tabular-nums font-mono">₱{{ number_format($payment->amount, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if($payment->status === 'paid')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-100 text-green-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                            Paid
                                        </span>
                                    @elseif($payment->status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-yellow-600"></span>
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-100 text-red-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    @endif
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">No payments yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-tenant-layout>



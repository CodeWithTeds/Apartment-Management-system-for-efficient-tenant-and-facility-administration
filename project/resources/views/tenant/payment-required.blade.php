<x-tenant-layout>
    <x-slot name="title">
        Payment Required
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 py-12">
        <div class="bg-white shadow overflow-hidden rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-red-50">
                <h3 class="text-lg leading-6 font-medium text-red-800">
                    <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Payment Required
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-red-700">
                    You need to make a payment to access the tenant dashboard.
                </p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <div class="text-center">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Access Restricted</h3>
                    <div class="mt-2 text-sm text-gray-500">
                        <p>Your access to the tenant dashboard is currently restricted because we haven't recorded any payments from you yet.</p>
                        <p class="mt-2">Please make your first payment to unlock full access to your tenant dashboard and all its features.</p>
                    </div>
                    
                    @if(isset($pendingPayment) && $pendingPayment)
                        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Pending Payment</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>You have a pending payment. Please complete your payment process.</p>
                                    </div>
                                    <div class="mt-4">
                                        <div class="-mx-2 -my-1.5 flex">
                                            <a href="{{ $pendingPayment->payment_link }}" class="bg-yellow-100 px-4 py-2 rounded-md text-sm font-medium text-yellow-800 hover:bg-yellow-200">
                                                Complete Payment
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="mt-8">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Return to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tenant-layout>

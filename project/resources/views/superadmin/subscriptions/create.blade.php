<x-superadmin-layout>
    <x-slot name="title">
        Create Subscription
    </x-slot>

    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <span class="font-medium">Error!</span> {{ session('error') }}
        </div>
    @endif

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Create Subscription</h1>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('superadmin.subscriptions.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="admin_id" class="block text-sm font-medium text-gray-700">Admin</label>
                    <select id="admin_id" name="admin_id" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="billing_email" class="block text-sm font-medium text-gray-700">Billing Email</label>
                    <input type="email" name="billing_email" id="billing_email" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="subscription_plan" class="block text-sm font-medium text-gray-700">Subscription Plan</label>
                    <select id="subscription_plan" name="subscription_plan" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>basic</option>
                        <option>premium</option>
                        <option>enterprise</option>
                        <option>standard</option>
                    </select>
                </div>
                <div>
                    <label for="billing_cycle" class="block text-sm font-medium text-gray-700">Billing Cycle</label>
                    <select id="billing_cycle" name="billing_cycle" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>monthly</option>
                        <option>quarterly</option>
                        <option>annually</option>
                    </select>
                </div>
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount" id="amount" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="md:col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
            </div>
            <div class="mt-8 flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Subscription
                </button>
            </div>
        </form>
    </div>
</x-superadmin-layout> 
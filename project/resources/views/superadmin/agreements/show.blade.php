<x-superadmin-layout>
    <x-slot name="title">
        View Agreement
    </x-slot>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Agreement Details</h1>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white rounded-lg shadow">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Agreement Title</label>
                <p class="text-sm text-gray-600">{{ $agreement->title }}</p>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                @switch($agreement->status)
                    @case('draft')
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Draft</span>
                        @break
                    @case('pending')
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Pending</span>
                        @break
                    @case('approved')
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Approved</span>
                        @break
                    @case('rejected')
                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Rejected</span>
                        @break
                @endswitch
            </div>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Admin</label>
                <p class="text-sm text-gray-600">{{ $agreement->admin->name }} ({{ $agreement->admin->email }})</p>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Created Date</label>
                <p class="text-sm text-gray-600">{{ $agreement->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
        </div>

        @if($agreement->admin_acknowledged_at)
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Acknowledged Date</label>
                    <p class="text-sm text-gray-600">{{ $agreement->admin_acknowledged_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Admin Notes</label>
                    <p class="text-sm text-gray-600">{{ $agreement->admin_notes ?: 'No notes provided' }}</p>
                </div>
            </div>
        @endif

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900">Agreement Content</label>
            <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                <div class="whitespace-pre-wrap text-sm text-gray-700">{{ $agreement->content }}</div>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('superadmin.agreements.edit', $agreement) }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Edit Agreement
            </a>
            <a href="{{ route('superadmin.agreements.index') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Back to List
            </a>
        </div>
    </div>
</x-superadmin-layout> 
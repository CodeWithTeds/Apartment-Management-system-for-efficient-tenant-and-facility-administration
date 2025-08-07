<x-superadmin-layout>
    <x-slot name="title">
        View Agreement
    </x-slot>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Agreement Document</h1>
            </div>
        </div>
    </div>

    <!-- Document Container -->
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg border border-gray-200 my-8">
        <!-- Document Header -->
        <div class="text-center mb-8 border-b-2 border-gray-300 pb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2 uppercase tracking-wide">LEASE AGREEMENT TEMPLATE</h1>
            <div class="text-gray-600 text-sm">
                <p>Document ID: #{{ $agreement->id }}</p>
                <p>Status: 
                    @switch($agreement->status)
                        @case('draft')
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded">Draft</span>
                            @break
                        @case('pending')
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded">Pending</span>
                            @break
                        @case('approved')
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">Approved</span>
                            @break
                        @case('rejected')
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">Rejected</span>
                            @break
                    @endswitch
                </p>
            </div>
        </div>

        <!-- Parties Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">PARTIES INVOLVED</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Landlord (Super Admin)</h3>
                    <p class="text-sm text-gray-600">Name: {{ $agreement->superAdmin->name ?? 'Not specified' }}</p>
                    <p class="text-sm text-gray-600">Email: {{ $agreement->superAdmin->email ?? 'Not specified' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Landlord (Admin)</h3>
                    <p class="text-sm text-gray-600">Name: {{ $agreement->admin->name ?? 'Not specified' }}</p>
                    <p class="text-sm text-gray-600">Email: {{ $agreement->admin->email ?? 'Not specified' }}</p>
                </div>
            </div>
        </div>

        <!-- Agreement Details -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">AGREEMENT DETAILS</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-1">Agreement Title</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $agreement->title }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-1">Created Date</label>
                    <p class="text-lg text-gray-900">{{ $agreement->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Agreement Content -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">AGREEMENT TERMS & CONDITIONS</h2>
            <div class="bg-gray-50 border border-gray-300 rounded-lg p-6">
                <div class="whitespace-pre-wrap text-gray-700 leading-relaxed">{{ $agreement->content }}</div>
            </div>
        </div>

        <!-- Status and Timeline -->
        @if($agreement->admin_acknowledged_at)
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">AGREEMENT STATUS</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                    <h3 class="font-semibold text-green-900 mb-2">Acknowledged</h3>
                    <p class="text-sm text-green-700">Date: {{ $agreement->admin_acknowledged_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                    <h3 class="font-semibold text-blue-900 mb-2">Admin Notes</h3>
                    <p class="text-sm text-blue-700">{{ $agreement->admin_notes ?: 'No notes provided' }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Document Footer -->
        <div class="mt-12 pt-6 border-t-2 border-gray-300">
            <div class="text-center">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">Agreement Approval</h3>
                    <p class="text-blue-800 leading-relaxed">
                        By approving this agreement, you acknowledge that you have read, understood, and agree to all the terms and conditions outlined above. 
                        This agreement constitutes a legally binding contract between the parties involved. 
                        Your approval indicates your acceptance of all responsibilities and obligations specified in this document.
                    </p>
                    @if($agreement->admin_acknowledged_at)
                        <div class="mt-4 p-3 bg-green-100 border border-green-200 rounded">
                            <p class="text-green-800 text-sm">
                                <strong>Approved on:</strong> {{ $agreement->admin_acknowledged_at->format('F d, Y \a\t h:i A') }}
                            </p>
                        </div>
                    @else
                        <div class="mt-4 p-3 bg-yellow-100 border border-yellow-200 rounded">
                            <p class="text-yellow-800 text-sm">
                                <strong>Status:</strong> Pending approval
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Document Actions -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex flex-wrap items-center justify-center space-x-4">
                <a href="{{ route('superadmin.agreements.edit', $agreement) }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Edit Agreement
                </a>
                <a href="{{ route('superadmin.agreements.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Back to Agreements
                </a>
            </div>
        </div>
    </div>
</x-superadmin-layout> 
<x-tenant-layout>
    <x-slot name="title">Agreement</x-slot>

    <div class="max-w-4xl mx-auto px-6 md:px-10 py-8">
        <div class="bg-white shadow rounded-xl border border-gray-100 p-6">
            <h1 class="text-2xl font-semibold text-gray-900 mb-4">{{ $agreement->title }}</h1>
            <div class="prose max-w-none">{!! nl2br(e($agreement->content)) !!}</div>

            <div class="mt-6 text-sm text-gray-600">
                <span class="font-medium">Status:</span> <span class="capitalize">{{ $agreement->status }}</span>
            </div>

            <div class="mt-6">
                <a href="{{ route('tenant.agreements.index') }}" class="px-4 py-2 rounded border">Back</a>
            </div>
        </div>
    </div>
</x-tenant-layout>



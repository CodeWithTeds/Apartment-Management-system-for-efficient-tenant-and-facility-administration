<x-tenant-layout>
    <x-slot name="title">Agreement</x-slot>

    <div class="max-w-4xl mx-auto px-6 md:px-10 py-8">
        <div class="bg-white shadow rounded-xl border border-gray-100 p-6">
            <h1 class="text-2xl font-semibold text-gray-900 mb-4">{{ $agreement->title }}</h1>
            <div class="prose max-w-none">{!! nl2br(e($agreement->content)) !!}</div>

            <div class="mt-6 text-sm text-gray-600">
                <span class="font-medium">Status:</span> <span class="capitalize">{{ $agreement->status }}</span>
            </div>

            <div class="mt-6 flex items-center gap-3">
                @if($agreement->channel === 'admin_to_tenant')
                    <form method="POST" action="{{ route('tenant.agreements.update', $agreement) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Accept</button>
                    </form>
                    <form method="POST" action="{{ route('tenant.agreements.update', $agreement) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Reject</button>
                    </form>
                @endif
                <a href="{{ route('tenant.agreements.index') }}" class="px-4 py-2 rounded border">Back</a>
            </div>
        </div>
    </div>
</x-tenant-layout>



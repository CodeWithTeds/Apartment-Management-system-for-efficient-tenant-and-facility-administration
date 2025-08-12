<x-tenant-layout>
    <x-slot name="title">New Maintenance Request</x-slot>

    <div class="max-w-5xl mx-auto px-6 md:px-10 py-10">
        @if(session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white/80 backdrop-blur rounded-2xl shadow-xl ring-1 ring-gray-100">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Create maintenance request</h2>
            </div>
            <form action="{{ route('tenant.maintenance.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. Aircon not cooling" required>
                        @error('title')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="5" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500" placeholder="Describe the issue, when it started, and any details that can help the team diagnose it.">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('tenant.dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 shadow">
                        Submit request
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-tenant-layout>



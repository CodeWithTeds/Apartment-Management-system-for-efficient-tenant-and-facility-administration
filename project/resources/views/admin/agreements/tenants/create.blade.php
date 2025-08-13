<x-admin-layout>
    <div class="container mx-auto px-4 py-6 max-w-3xl">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">New Tenant Agreement</h1>

        <form method="POST" action="{{ route('admin.agreements.tenants.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tenant</label>
                <select name="tenant_id" class="w-full border rounded px-3 py-2">
                    <option value="">Select tenant</option>
                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}" {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>{{ $tenant->name }} ({{ $tenant->email }})</option>
                    @endforeach
                </select>
                @error('tenant_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2" />
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea name="content" rows="10" class="w-full border rounded px-3 py-2">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
                @error('status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Create</button>
                <a href="{{ route('admin.agreements.tenants.index') }}" class="px-4 py-2 rounded border">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>



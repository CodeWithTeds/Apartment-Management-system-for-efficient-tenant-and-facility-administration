<x-admin-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">New Tenant Report</h1>
            <a href="{{ route('admin.reports.index') }}" class="text-sm text-gray-600 hover:text-gray-800">Back</a>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-100">
            <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tenant</label>
                        <select name="tenant_id" class="w-full rounded border-gray-200 focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="" disabled selected>Select tenant</option>
                            @foreach($tenants as $tenant)
                                <option value="{{ $tenant->id }}">{{ $tenant->name }} ({{ $tenant->email }})</option>
                            @endforeach
                        </select>
                        @error('tenant_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Report name</label>
                        <input type="text" name="report_name" class="w-full rounded border-gray-200 focus:border-blue-500 focus:ring-blue-500" required>
                        @error('report_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full rounded border-gray-200 focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">File (PDF/CSV/TXT/PNG/JPG/JPEG)</label>
                    <input type="file" name="file" accept=".pdf,.csv,.txt,.png,.jpg,.jpeg" class="w-full rounded border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                    @error('file') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 rounded border border-gray-200 text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-5 py-2.5 rounded bg-blue-600 text-white hover:bg-blue-700">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>



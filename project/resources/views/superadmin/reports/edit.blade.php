<x-superadmin-layout>
    <x-slot name="title">
        Edit Report
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Report Details</h2>
            <form action="{{ route('superadmin.reports.update', $report->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="report_name" class="block text-sm font-medium text-gray-700">Report Name</label>
                        <input type="text" id="report_name" name="report_name" value="{{ $report->report_name }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="report_type" class="block text-sm font-medium text-gray-700">Report Type</label>
                        <select id="report_type" name="report_type" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="sales" {{ $report->report_type == 'sales' ? 'selected' : '' }}>Sales Report</option>
                            <option value="user_activity" {{ $report->report_type == 'user_activity' ? 'selected' : '' }}>User Activity</option>
                            <option value="property_listings" {{ $report->report_type == 'property_listings' ? 'selected' : '' }}>Property Listings</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="date_range" class="block text-sm font-medium text-gray-700">Date Range</label>
                        <select id="date_range" name="date_range" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="last_7_days" {{ $report->date_range == 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
                            <option value="last_30_days" {{ $report->date_range == 'last_30_days' ? 'selected' : '' }}>Last 30 Days</option>
                            <option value="last_90_days" {{ $report->date_range == 'last_90_days' ? 'selected' : '' }}>Last 90 Days</option>
                            <option value="custom" {{ $report->date_range == 'custom' ? 'selected' : '' }}>Custom Range</option>
                        </select>
                    </div>
                    <div id="custom_date_range" style="{{ $report->date_range == 'custom' ? 'display: block;' : 'display: none;' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" id="start_date" name="start_date" value="{{ $report->start_date ? $report->start_date->format('Y-m-d') : '' }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" id="end_date" name="end_date" value="{{ $report->end_date ? $report->end_date->format('Y-m-d') : '' }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $report->description }}</textarea>
                </div>
                <div class="mt-6">
                    <label for="format" class="block text-sm font-medium text-gray-700">Format</label>
                    <select id="format" name="format" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="pdf" {{ $report->format == 'pdf' ? 'selected' : '' }}>PDF</option>
                        <option value="csv" {{ $report->format == 'csv' ? 'selected' : '' }}>CSV</option>
                        <option value="xlsx" {{ $report->format == 'xlsx' ? 'selected' : '' }}>XLSX</option>
                    </select>
                </div>
                <div class="mt-6">
                    <label for="assignable" class="block text-sm font-medium text-gray-700">Assign to</label>
                    <select id="assignable" name="assignable" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="">Select a user</option>
                        <optgroup label="Super Admins">
                            @foreach($assignees->where('assignable_type', App\Models\SuperAdmin::class) as $admin)
                                <option value="{{ get_class($admin) }}-{{ $admin->id }}" {{ $report->assignable_type == get_class($admin) && $report->assignable_id == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                            @endforeach
                        </optgroup>
                                            <optgroup label="Property Owners">
                        @foreach($assignees->where('assignable_type', App\Models\User::class) as $user)
                            <option value="{{ get_class($user) }}-{{ $user->id }}" {{ $report->assignable_type == get_class($user) && $report->assignable_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </optgroup>
                    </select>
                </div>
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('superadmin.reports.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md shadow-sm">Cancel</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-sm">Update Report</button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
    <script>
        document.getElementById('date_range').addEventListener('change', function () {
            if (this.value === 'custom') {
                document.getElementById('custom_date_range').style.display = 'block';
            } else {
                document.getElementById('custom_date_range').style.display = 'none';
            }
        });
    </script>
    @endpush
</x-superadmin-layout>

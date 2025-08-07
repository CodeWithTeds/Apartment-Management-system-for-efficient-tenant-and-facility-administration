<x-superadmin-layout>
    <x-slot name="title">
        Reports
    </x-slot>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Reports</h1>
            </div>
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100">
                <div class="flex items-center mb-4 sm:mb-0">
                    <form class="sm:pr-3" action="#" method="GET">
                        <label for="reports-search" class="sr-only">Search</label>
                        <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                            <input type="text" name="search" id="reports-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Search for reports">
                        </div>
                    </form>
                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <a href="{{ route('superadmin.reports.create') }}"
                        class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Create Report
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">Report Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">Date Range</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">Generated At</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reports as $report)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r border-gray-300">{{ $report->report_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-300">{{ $report->report_type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-300">{{ $report->date_range }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-r border-gray-300">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $report->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $report->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-300">{{ $report->completed_at ? $report->completed_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($report->status == 'completed')
                                <a href="{{ $report->file_path }}" class="text-indigo-600 hover:text-indigo-900" download>Download</a>
                                @endif
                                <a href="{{ route('superadmin.reports.show', $report->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">View</a>
                                <form action="{{ route('superadmin.reports.destroy', $report->id) }}" method="POST" class="inline-block ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No reports found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-superadmin-layout>

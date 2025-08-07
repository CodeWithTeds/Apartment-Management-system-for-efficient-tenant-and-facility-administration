<x-superadmin-layout>
    <x-slot name="title">
        View Report
    </x-slot>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Report Document</h1>
            </div>
        </div>
    </div>

    <!-- Document Container -->
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg border border-gray-200 my-8">
        <!-- Document Header -->
        <div class="text-center mb-8 border-b-2 border-gray-300 pb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $report->report_name }}</h2>
                    <p class="text-gray-600">Report ID: #{{ $report->id }}</p>
                </div>
                <div class="text-right">
                    @switch($report->status)
                        @case('completed')
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">Completed</span>
                            @break
                        @case('pending')
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">Pending</span>
                            @break
                        @default
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-3 py-1 rounded-full">{{ ucfirst($report->status) }}</span>
                    @endswitch
                </div>
            </div>
        </div>

        <!-- Document Metadata -->
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Report Type</label>
                <p class="text-sm text-gray-600">{{ $report->report_type }}</p>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Format</label>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                           {{ $report->format === 'pdf' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                    {{ strtoupper($report->format) }}
                </span>
            </div>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Date Range</label>
                <p class="text-sm text-gray-600">{{ $report->date_range }}</p>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Assigned To</label>
                <p class="text-sm text-gray-600">
                    @if($report->assignable)
                        {{ $report->assignable->name ?? $report->assignable->email }}
                        <span class="text-xs text-gray-500">({{ class_basename($report->assignable_type) }})</span>
                    @else
                        <span class="text-gray-500">Not assigned</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Created Date</label>
                <p class="text-sm text-gray-600">{{ $report->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
            @if($report->completed_at)
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Completed Date</label>
                <p class="text-sm text-gray-600">{{ $report->completed_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
            @endif
        </div>

        @if($report->start_date || $report->end_date)
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            @if($report->start_date)
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Start Date</label>
                <p class="text-sm text-gray-600">{{ $report->start_date->format('M d, Y') }}</p>
            </div>
            @endif
            @if($report->end_date)
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">End Date</label>
                <p class="text-sm text-gray-600">{{ $report->end_date->format('M d, Y') }}</p>
            </div>
            @endif
        </div>
        @endif

        @if($report->description)
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900">Report Description</label>
            <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                <div class="whitespace-pre-wrap text-sm text-gray-700">{{ $report->description }}</div>
            </div>
        </div>
        @endif

        <!-- Document Actions -->
        @if($report->file_path && $report->status === 'completed')
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-green-800 mb-1">Report Generated Successfully</h3>
                    <p class="text-green-600 text-sm">Your report is ready for download</p>
                </div>
                <a href="{{ $report->file_path }}" 
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download Report
                </a>
            </div>
        </div>
        @elseif($report->status === 'pending')
        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-yellow-800 mb-1">Report Generation in Progress</h3>
                    <p class="text-yellow-600 text-sm">Please wait while your report is being generated</p>
                </div>
                <form method="POST" action="{{ route('superadmin.reports.generate', $report) }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Regenerate Report
                    </button>
                </form>
            </div>
        </div>
        @endif

        <!-- Document Footer -->
        <div class="mt-12 pt-6 border-t-2 border-gray-300">
            <div class="text-center">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">Report Information</h3>
                    <p class="text-blue-800 leading-relaxed">
                        This report contains detailed information and analytics based on the specified parameters. 
                        The data has been processed and compiled according to the report type and date range requirements.
                        All information is accurate as of the generation date and time.
                    </p>
                    @if($report->completed_at)
                        <div class="mt-4 p-3 bg-green-100 border border-green-200 rounded">
                            <p class="text-green-800 text-sm">
                                <strong>Generated on:</strong> {{ $report->completed_at->format('F d, Y \a\t h:i A') }}
                            </p>
                        </div>
                    @else
                        <div class="mt-4 p-3 bg-yellow-100 border border-yellow-200 rounded">
                            <p class="text-yellow-800 text-sm">
                                <strong>Status:</strong> Pending generation
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Document Actions -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex flex-wrap items-center justify-center space-x-4">
                <a href="{{ route('superadmin.reports.edit', $report) }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Edit Report
                </a>
                <form method="POST" action="{{ route('superadmin.reports.destroy', $report) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            onclick="return confirm('Are you sure you want to delete this report?')">
                        Delete Report
                    </button>
                </form>
                <a href="{{ route('superadmin.reports.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Back to Reports
                </a>
            </div>
        </div>
    </div>
</x-superadmin-layout>

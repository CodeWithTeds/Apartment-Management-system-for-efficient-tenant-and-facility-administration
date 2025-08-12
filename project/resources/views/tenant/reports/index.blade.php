<x-tenant-layout>
    <x-slot name="title">My Reports</x-slot>

    <div class="max-w-screen-2xl mx-auto px-6 md:px-10 py-8">
        <div class="bg-white shadow-xl rounded-xl border border-gray-100">
            <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white rounded-t-xl flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Reports assigned to you</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-[900px] w-full">
                    <thead class="sticky top-0 z-10">
                        <tr class="text-xs uppercase tracking-wide text-gray-600 bg-gray-50/80 backdrop-blur">
                            <th class="px-6 py-3 text-left">Date</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">File</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($reports as $report)
                            <tr class="text-sm text-gray-700 odd:bg-white even:bg-gray-50 hover:bg-blue-50/60 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $report->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4 font-medium">{{ $report->report_name }}</td>
                                <td class="px-6 py-4">
                                    @if($report->file_path)
                                        <a href="{{ asset($report->file_path) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v4"/><path d="M10 14 21 3"/><path d="M21 10v11a2 2 0 0 1-2 2H8"/><path d="M3 15V4a2 2 0 0 1 2-2h11"/></svg>
                                            View
                                        </a>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">No reports available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-tenant-layout>



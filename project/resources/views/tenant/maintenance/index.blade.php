<x-tenant-layout>
    <x-slot name="title">Maintenance Requests</x-slot>

    <div x-data="{ open: false }" class="max-w-screen-2xl mx-auto px-6 md:px-10 py-8">
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow-xl rounded-xl border border-gray-100">
            <div class="px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white rounded-t-xl flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Your maintenance requests</h2>
                <button @click="open = true" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                    New request
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-[900px] w-full">
                    <thead class="sticky top-0 z-10">
                        <tr class="text-xs uppercase tracking-wide text-gray-600 bg-gray-50/80 backdrop-blur">
                            <th class="px-6 py-3 text-left">Requested</th>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Description</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Completed</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($requests as $req)
                            <tr class="text-sm text-gray-700 odd:bg-white even:bg-gray-50 hover:bg-blue-50/60 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">{{ optional($req->requested_at ?? $req->created_at)->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4 font-medium">{{ $req->title }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ Str::limit($req->description, 120) }}</td>
                                <td class="px-6 py-4">
                                    @php($status = strtolower($req->status))
                                    @if($status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700"><span class="h-1.5 w-1.5 rounded-full bg-yellow-600"></span> Pending</span>
                                    @elseif($status === 'in progress')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-blue-100 text-blue-700"><span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span> In progress</span>
                                    @elseif($status === 'completed')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-100 text-green-700"><span class="h-1.5 w-1.5 rounded-full bg-green-600"></span> Completed</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-gray-100 text-gray-700"><span class="h-1.5 w-1.5 rounded-full bg-gray-600"></span> {{ ucfirst($req->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $req->completed_at ? $req->completed_at->format('M d, Y H:i') : '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">No maintenance requests yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div @click="open = false" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
            <div class="relative w-full max-w-2xl mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="px-6 py-4 border-b flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">New maintenance request</h3>
                    <button @click="open = false" class="p-2 rounded hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="M6 6l12 12"/></svg>
                    </button>
                </div>
                <form action="{{ route('tenant.maintenance.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" name="title" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. Aircon not cooling" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="5" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500" placeholder="Describe the issue, when it started, and any helpful details."></textarea>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" @click="open = false" class="inline-flex items-center px-4 py-2 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 shadow">Submit request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-tenant-layout>



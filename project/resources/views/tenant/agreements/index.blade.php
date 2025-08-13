<x-tenant-layout>
    <x-slot name="title">Lease Agreements</x-slot>

    <div class="max-w-screen-2xl mx-auto px-6 md:px-10 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">My Lease Agreements</h1>
        </div>

        <div class="bg-white shadow-xl rounded-xl border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-[800px] w-full">
                    <thead>
                        <tr class="text-xs uppercase tracking-wide text-gray-600 bg-gray-50">
                            <th class="px-6 py-3 text-left">Date</th>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($agreements as $agreement)
                            <tr class="text-sm text-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $agreement->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">{{ $agreement->title }}</td>
                                <td class="px-6 py-4 capitalize">{{ $agreement->status }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('tenant.agreements.show', $agreement) }}" class="text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500">No agreements found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-tenant-layout>



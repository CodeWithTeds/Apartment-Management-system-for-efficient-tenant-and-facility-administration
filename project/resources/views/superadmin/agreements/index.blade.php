<x-superadmin-layout>
    <x-slot name="title">
        Agreements Management
    </x-slot>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Agreements</h1>
            </div>
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100">
                <div class="flex items-center mb-4 sm:mb-0">
                    <form class="sm:pr-3" action="#" method="GET">
                        <label for="agreements-search" class="sr-only">Search</label>
                        <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                            <input type="text" name="search" id="agreements-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Search for agreements">
                        </div>
                    </form>
                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <a href="{{ route('superadmin.agreements.create') }}"
                        class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add Agreement
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase border-r border-gray-300">
                        Title
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase border-r border-gray-300">
                        Admin
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase border-r border-gray-300">
                        Status
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase border-r border-gray-300">
                        Created
                    </th>
                    <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($agreements as $agreement)
                    <tr class="hover:bg-gray-100">
                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap border-r border-gray-300">
                            <div class="text-base font-semibold text-gray-900">{{ $agreement->title }}</div>
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap border-r border-gray-300">
                            {{ $agreement->admin->name }}
                        </td>
                        <td class="p-4 whitespace-nowrap border-r border-gray-300">
                            @switch($agreement->status)
                                @case('draft')
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Draft</span>
                                    @break
                                @case('pending')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Pending</span>
                                    @break
                                @case('approved')
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Approved</span>
                                    @break
                                @case('rejected')
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Rejected</span>
                                    @break
                            @endswitch
                        </td>
                        <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap border-r border-gray-300">
                            {{ $agreement->created_at->format('M d, Y') }}
                        </td>
                        <td class="p-4 space-x-2 whitespace-nowrap">
                            <a href="{{ route('superadmin.agreements.show', $agreement) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                View
                            </a>
                            <a href="{{ route('superadmin.agreements.edit', $agreement) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                    </path>
                                    <path fill-rule="evenodd"
                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('superadmin.agreements.destroy', $agreement) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this agreement?')"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            No agreements found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between sm:p-6 lg:px-8 xl:px-10">
        <div class="flex items-center mb-4 sm:mb-0">
            @if($agreements->hasPages())
                <div class="text-sm font-normal text-gray-500">
                    Showing
                    <span class="font-semibold text-gray-900">{{ $agreements->firstItem() }}-{{ $agreements->lastItem() }}</span>
                    of
                    <span class="font-semibold text-gray-900">{{ $agreements->total() }}</span>
                </div>
            @endif
        </div>
        <div class="flex items-center space-x-3">
            @if($agreements->hasPages())
                {{ $agreements->links() }}
            @endif
        </div>
    </div>
</x-superadmin-layout> 
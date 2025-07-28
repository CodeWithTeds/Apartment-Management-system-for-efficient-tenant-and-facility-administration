<x-superadmin-layout>
    <x-slot name="title">
        Property Applications
    </x-slot>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">All Applications</h1>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Applicant Name
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Property Name
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Status
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($applications as $application)
                                <tr class="hover:bg-gray-100">
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        <div class="text-base font-semibold text-gray-900">{{ $application->full_name }}</div>
                                        <div class="text-sm font-normal text-gray-500">{{ $application->email }}</div>
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap">{{ $application->property_name }}</td>
                                    <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full
                                                @switch($application->application_status)
                                                    @case('pending')
                                                        bg-yellow-400
                                                        @break
                                                    @case('approved')
                                                        bg-green-400
                                                        @break
                                                    @case('rejected')
                                                        bg-red-400
                                                        @break
                                                    @default
                                                        bg-gray-400
                                                @endswitch
                                                mr-2"></div>
                                            {{ ucfirst($application->application_status) }}
                                        </div>
                                    </td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <a href="{{ route('superadmin.applications.show', $application) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                            View
                                        </a>
                                        <form action="{{ route('superadmin.applications.destroy', $application) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300" onclick="return confirm('Are you sure you want to delete this application?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4">
        {{ $applications->links() }}
    </div>
</x-superadmin-layout>

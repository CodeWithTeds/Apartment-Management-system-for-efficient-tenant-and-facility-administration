<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Inquiries</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all the inquiries from customers.</p>
            </div>
        </div>

        <div class="mt-4">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a href="{{ route('admin.inquiries.index') }}" class="{{ !$filter ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        All
                    </a>
                    <a href="{{ route('admin.inquiries.index', ['filter' => 'accepted']) }}" class="{{ $filter === 'accepted' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Accepted
                    </a>
                    <a href="{{ route('admin.inquiries.index', ['filter' => 'pending']) }}" class="{{ $filter === 'pending' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Pending
                    </a>
                </nav>
            </div>
        </div>
        
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Full Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Mobile No.</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Stay Type</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Message</th>
<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
<th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
    <span class="sr-only">Edit</span>
</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($inquiries as $inquiry)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $inquiry->full_name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $inquiry->email }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $inquiry->mobile_no }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $inquiry->stay_type }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $inquiry->message }}</td>
<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $inquiry->status }}</td>
<td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-indigo-600 hover:text-indigo-900">View<span class="sr-only">, {{ $inquiry->full_name }}</span></a>
</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $inquiries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

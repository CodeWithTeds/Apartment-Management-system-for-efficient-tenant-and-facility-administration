<x-superadmin-layout>
    <x-slot name="title">
        Application Details
    </x-slot>

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Application from {{ $application->full_name }}</h1>
            </div>
        </div>
    </div>

    <div class="p-4 space-y-6">
        <div class="bg-white shadow rounded-lg p-6 dark:bg-gray-800">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Applicant Information</h3>
                    <div class="mt-4 space-y-4">
                        <p><span class="font-semibold">Name:</span> {{ $application->full_name }}</p>
                        <p><span class="font-semibold">Email:</span> {{ $application->email }}</p>
                        <p><span class="font-semibold">Phone:</span> {{ $application->phone_number ?? 'N/A' }}</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Property Information</h3>
                    <div class="mt-4 space-y-4">
                        <p><span class="font-semibold">Property Name:</span> {{ $application->property_name }}</p>
                        <p><span class="font-semibold">Address:</span> {{ $application->property_address }}</p>
                        <p><span class="font-semibold">Description:</span> {{ $application->description ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Uploaded Document</h3>
                <div class="mt-4">
                    <a href="{{ asset('storage/' . $application->document_path) }}" target="_blank" class="text-blue-600 hover:underline">View Document</a>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <form action="{{ route('superadmin.applications.update', $application) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="approved">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Approve</button>
            </form>
            <form action="{{ route('superadmin.applications.update', $application) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="rejected">
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Reject</button>
            </form>
        </div>
    </div>
</x-superadmin-layout>

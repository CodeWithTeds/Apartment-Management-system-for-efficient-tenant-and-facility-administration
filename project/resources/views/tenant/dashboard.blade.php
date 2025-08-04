<x-tenant-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <div class="flex items-center p-4 bg-blue-500 rounded-lg shadow-xs">
            <div>
                <p class="mb-2 text-sm font-medium text-white">
                    Payment
                </p>
                <p class="text-lg font-semibold text-white">
                    3500
                </p>
                <p class="text-xs text-white">
                    Due Date: December 31 2025
                </p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Rent Due
                </p>
                <p class="text-lg font-semibold text-gray-700">
                    December 10, 2025
                </p>
            </div>
        </div>
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">
                    Maintenance Status
                </p>
                <ul>
                    <li class="text-sm text-gray-600">Request 001: <span class="text-yellow-500">In Progress</span></li>
                    <li class="text-sm text-gray-600">Request 002: <span class="text-green-500">Completed</span></li>
                    <li class="text-sm text-gray-600">Request 002: <span class="text-red-500">Pending</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Payment History</h2>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Payment Date</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    <tr class="text-gray-700">
                        <td class="px-4 py-3">
                            September 2025
                        </td>
                        <td class="px-4 py-3 text-sm">
                            P4000.00
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                Paid
                            </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700">
                        <td class="px-4 py-3">
                            October 2025
                        </td>
                        <td class="px-4 py-3 text-sm">
                            P4000.00
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                Paid
                            </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700">
                        <td class="px-4 py-3">
                            November 2025
                        </td>
                        <td class="px-4 py-3 text-sm">
                            P4000.00
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                Paid
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
                <a href="#" class="text-blue-500 hover:text-blue-700">See Invoices</a>
            </div>
        </div>
    </div>
</x-tenant-layout>

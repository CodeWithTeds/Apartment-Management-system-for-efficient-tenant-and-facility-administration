<x-superadmin-layout>
    <main class="flex-1 p-6">
        <h2 class="mb-6 text-3xl font-bold">DASHBOARD</h2>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 text-white bg-blue-500 rounded-lg shadow-lg">
                <h3 class="text-lg">Total Property</h3>
                <p class="text-4xl font-bold">6</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg text-gray-600">Total Unit</h3>
                <p class="text-4xl font-bold text-gray-800">72</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg text-gray-600">Total Tenants</h3>
                <p class="text-4xl font-bold text-gray-800">52</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg text-gray-600">Total Admins</h3>
                <p class="text-4xl font-bold text-gray-800">6</p>
            </div>
        </div>

        <!-- Properties Table -->
        <div class="p-6 mb-6 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-xl font-bold">Properties</h3>
            <table class="w-full">
                <thead>
                    <tr class="text-left text-gray-600">
                        <th class="pb-2">Apartment Name</th>
                        <th class="pb-2">Admin</th>
                        <th class="pb-2">Total Units</th>
                        <th class="pb-2">Units Occupied</th>
                        <th class="pb-2">Monthly Income</th>
                        <th class="pb-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-2">ARCO APARTMENT</td>
                        <td class="py-2">John Doe Arco</td>
                        <td class="py-2">10</td>
                        <td class="py-2">7</td>
                        <td class="py-2">P24,500.00</td>
                        <td class="py-2 text-green-500">Active</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2">MARK APARTMENT</td>
                        <td class="py-2">Mark Dicierra</td>
                        <td class="py-2">7</td>
                        <td class="py-2">5</td>
                        <td class="py-2">P15,800.00</td>
                        <td class="py-2 text-green-500">Active</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Subscription & Billing Summary Table -->
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-xl font-bold">Subscription & Billing Summary</h3>
            <table class="w-full">
                <thead>
                    <tr class="text-left text-gray-600">
                        <th class="pb-2">Admin Name</th>
                        <th class="pb-2">Email</th>
                        <th class="pb-2">Subscription Status</th>
                        <th class="pb-2">Renewal Data</th>
                        <th class="pb-2">Last Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-2">John Doe Arco</td>
                        <td class="py-2">JoArco@gmail.com</td>
                        <td class="py-2 text-green-500">Active</td>
                        <td class="py-2">2025-05-15</td>
                        <td class="py-2">2025-04-15</td>
                    </tr>
                     <tr class="border-t">
                        <td class="py-2">Mark Dicierra</td>
                        <td class="py-2">MaDicie@gmail.com</td>
                        <td class="py-2 text-green-500">Active</td>
                        <td class="py-2">2025-05-25</td>
                        <td class="py-2">2025-04-25</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</x-superadmin-layout> 
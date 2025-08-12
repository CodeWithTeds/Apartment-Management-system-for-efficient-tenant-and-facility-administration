<x-superadmin-layout>
    <main class="flex-1 p-6">
        <h2 class="mb-6 text-3xl font-bold">DASHBOARD</h2>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 text-white bg-blue-500 rounded-lg shadow-lg">
                <h3 class="text-lg">Total Property</h3>
                <p class="text-4xl font-bold">{{ $totalProperties }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg text-gray-600">Total Unit</h3>
                <p class="text-4xl font-bold text-gray-800">{{ $totalUnits }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg text-gray-600">Total Tenants</h3>
                <p class="text-4xl font-bold text-gray-800">{{ $totalTenants }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg text-gray-600">Total Admins</h3>
                <p class="text-4xl font-bold text-gray-800">{{ $totalAdmins }}</p>
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
                     
                        <th class="pb-2">Monthly Income</th>
                        <th class="pb-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apartments as $apartment)
                    <tr class="border-t">
                        <td class="py-2">{{ $apartment->name }}</td>
                        <td class="py-2">{{ $apartment->owner->name ?? 'N/A' }}</td>
                        <td class="py-2">{{ $apartment->total_units }}</td>
                      
                        <td class="py-2">${{ number_format($apartment->monthly_price, 2) }}</td>
                        <td class="py-2 text-green-500">{{ ucfirst($apartment->status) }}</td>
                    </tr>
                    @endforeach
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
                    @foreach($subscriptions as $subscription)
                    <tr class="border-t">
                        <td class="py-2">{{ $subscription->user->name ?? 'N/A' }}</td>
                        <td class="py-2">{{ $subscription->user->email ?? 'N/A' }}</td>
                        <td class="py-2 text-green-500">{{ ucfirst($subscription->payment_status) }}</td>
                        <td class="py-2">{{ $subscription->renewal_date ? \Carbon\Carbon::parse($subscription->renewal_date)->format('Y-m-d') : 'N/A' }}</td>
                        <td class="py-2">{{ $subscription->last_payment_date ? \Carbon\Carbon::parse($subscription->last_payment_date)->format('Y-m-d') : 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</x-superadmin-layout>
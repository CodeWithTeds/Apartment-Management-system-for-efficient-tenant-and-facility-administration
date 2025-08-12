<!-- Sidebar -->
<aside x-show="sidebarOpen" class="flex flex-col w-64 bg-white shadow-lg">
    <div class="flex items-center justify-center h-20 shadow-md">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-50">
    </div>
    <nav class="flex-1 px-4 py-8 space-y-2">
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Dashboard</span>
        </a>
        <a href="{{ route('admin.property.index') }}"
            class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.property.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Apartment</span>
        </a>
        <a href="{{ route('admin.units.index') }}"
            class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.units.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Units</span>
        </a>
        <a href="{{ route('admin.inquiries.index', ['filter' => 'accepted']) }}"
            class="flex items-center px-4 py-3 rounded-lg {{ request('filter') === 'accepted' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Tenants</span>
        </a>
        <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.payments.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Payment</span>
        </a>
        <a href="{{ route('admin.maintenance.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.maintenance.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Maintenance Request</span>
        </a>

        <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Reports</span>
        </a>
        <a href="{{ route('admin.agreements.index') }}"
            class="flex items-center px-4 py-3 rounded-lg
                  {{ request()->routeIs('admin.agreements.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Lease Agreements</span>
        </a>
    </nav>
</aside>

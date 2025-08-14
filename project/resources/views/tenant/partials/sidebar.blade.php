<!-- Sidebar -->
<aside x-show="sidebarOpen" class="flex flex-col w-64 bg-white shadow-lg">
    <div class="flex items-center justify-center h-20 shadow-md">
        @if(isset($ownerLogo) && $ownerLogo)
            <img src="{{ Storage::url($ownerLogo) }}" alt="Property Owner Logo" class="h-16">
        @else
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-16">
        @endif
    </div>
    <nav class="flex-1 px-4 py-8 space-y-2">
        <a href="{{ route('tenant.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('tenant.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Dashboard</span>
        </a>
        <a href="{{ route('tenant.payments.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('tenant.payments.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Payments</span>
        </a>
        <a href="{{ route('tenant.maintenance.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('tenant.maintenance.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Maintenance Request</span>
        </a>
        <a href="{{ route('tenant.agreements.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('tenant.agreements.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Lease Agreements</span>
        </a>
        <a href="{{ route('tenant.reports.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('tenant.reports.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Reports</span>
        </a>
    </nav>
</aside>

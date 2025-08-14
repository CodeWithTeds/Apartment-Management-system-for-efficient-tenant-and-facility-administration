<!-- Sidebar -->
<aside x-show="sidebarOpen" class="flex flex-col w-64 bg-gradient-to-b from-blue-900 to-blue-800 shadow-2xl">
    <div class="flex items-center justify-center h-20 border-b border-blue-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center overflow-hidden">
                @if(isset($ownerLogo) && $ownerLogo)
                    <img src="{{ Storage::url($ownerLogo) }}" alt="Property Owner Logo" class="h-8 w-8">
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-8 w-8">
                @endif
            </div>
            <div>
                <h1 class="text-white font-bold text-lg">HYSLOP</h1>
                <p class="text-blue-200 text-xs">Tenant Panel</p>
            </div>
        </div>
    </div>
    <nav class="flex-1 px-4 py-8 space-y-2">
        <a href="{{ route('tenant.dashboard') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('tenant.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Dashboard</span>
        </a>
        <a href="{{ route('tenant.payments.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('tenant.payments.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Payments</span>
        </a>
        <a href="{{ route('tenant.maintenance.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('tenant.maintenance.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Maintenance Request</span>
        </a>
        <a href="{{ route('tenant.agreements.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('tenant.agreements.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Lease Agreements</span>
        </a>
        <a href="{{ route('tenant.reports.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('tenant.reports.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Reports</span>
        </a>
    </nav>
</aside>

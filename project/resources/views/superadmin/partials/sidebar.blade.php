<!-- Sidebar -->
<aside x-show="sidebarOpen" class="flex flex-col w-64 bg-white shadow-lg">
    <div class="flex items-center justify-center h-20 shadow-md">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-50">
    </div>
    <nav class="flex-1 px-4 py-8 space-y-2">
        <a href="{{ route('superadmin.dashboard') }}"
            class="flex items-center px-4 py-3 rounded-lg
                  {{ request()->routeIs('superadmin.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Dashboard</span>
        </a>
        <a href="{{ route('superadmin.property.index') }}"
            class="flex items-center px-4 py-3 rounded-lg
                  {{ request()->routeIs('superadmin.property.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Property</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100">
            <span class="font-semibold">Users</span>
        </a>
        <a href="{{ route('superadmin.applications.index') }}"
            class="flex items-center px-4 py-3 rounded-lg
                  {{ request()->routeIs('superadmin.applications.*') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
            <span class="font-semibold">Applicants</span>
        </a>
        <a href="{{ route('superadmin.subscriptions.index') }}"
            class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100">
            <span class="font-semibold">Subscription Billing</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100">
            <span class="font-semibold">Reports</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100">
            <span class="font-semibold">Agreements</span>
        </a>
    </nav>
</aside>

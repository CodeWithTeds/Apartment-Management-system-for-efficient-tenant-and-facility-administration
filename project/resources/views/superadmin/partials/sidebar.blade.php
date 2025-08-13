<!-- Modern Sidebar -->
<aside x-show="sidebarOpen" class="flex flex-col w-64 bg-gradient-to-b from-blue-900 to-blue-800 shadow-2xl">
    <!-- Logo Section -->
    <div class="flex items-center justify-center h-20 border-b border-blue-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-8 w-8">
            </div>
            <div>
                <h1 class="text-white font-bold text-lg">HYSLOP</h1>
                <p class="text-blue-200 text-xs">Admin Panel</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('superadmin.dashboard') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group
                  {{ request()->routeIs('superadmin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Property -->
        <a href="{{ route('superadmin.property.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group
                  {{ request()->routeIs('superadmin.property.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <span class="font-medium">Properties</span>
        </a>


        <!-- Applicants -->
        <a href="{{ route('superadmin.applications.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group
                  {{ request()->routeIs('superadmin.applications.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="font-medium">Applicants</span>
        </a>

        <!-- Subscription Billing -->
        <a href="{{ route('superadmin.subscriptions.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group text-blue-100 hover:bg-blue-700 hover:text-white">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <span class="font-medium">Billing</span>
        </a>

        <!-- Reports Dropdown -->
        <div x-data="{ open: {{ request()->routeIs('superadmin.reports.*') ? 'true' : 'false' }} }">
            <button type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('superadmin.reports.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="font-medium">Reports</span>
                </span>
                <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" class="mt-1 ml-6 space-y-1">
                <a href="{{ route('superadmin.reports.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('superadmin.reports.index') ? 'bg-blue-600/60 text-white' : 'text-blue-100 hover:bg-blue-700/50 hover:text-white' }}">
                    <span>To Admin</span>
                </a>
                <a href="{{ route('superadmin.reports.create') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('superadmin.reports.create') ? 'bg-blue-600/60 text-white' : 'text-blue-100 hover:bg-blue-700/50 hover:text-white' }}">
                    <span>Create</span>
                </a>
            </div>
        </div>

        <!-- Agreements -->
        <a href="{{ route('superadmin.agreements.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group
                  {{ request()->routeIs('superadmin.agreements.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="font-medium">Agreements</span>
        </a>
    </nav>

    <!-- Logout Section -->
    <div class="p-4 border-t border-blue-700">
        <form method="POST" action="{{ route('superadmin.logout') }}" class="w-full" onsubmit="return confirm('Are you sure you want to logout?')">
            @csrf
            <button type="submit" 
                class="flex items-center w-full px-4 py-3 rounded-xl transition-all duration-200 group text-red-100 hover:bg-red-600 hover:text-white"
                onclick="console.log('Logout button clicked');">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>

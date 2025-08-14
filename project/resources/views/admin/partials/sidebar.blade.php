<!-- Sidebar -->
<aside x-show="sidebarOpen" class="flex flex-col w-64 bg-gradient-to-b from-blue-900 to-blue-800 shadow-2xl">
    <div class="flex items-center justify-center h-20 border-b border-blue-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center overflow-hidden">
                @if(auth()->user()->logo_path)
                    <img src="{{ Storage::url(auth()->user()->logo_path) }}" alt="logo" class="h-8 w-8">
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-8 w-8">
                @endif
            </div>
            <div>
                <h1 class="text-white font-bold text-lg">HYSLOP</h1>
                <p class="text-blue-200 text-xs">Admin Panel</p>
            </div>
        </div>
    </div>
    <nav class="flex-1 px-4 py-8 space-y-2">
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Dashboard</span>
        </a>
        <a href="{{ route('admin.property.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.property.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Apartment</span>
        </a>
        <a href="{{ route('admin.units.index') }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.units.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Units</span>
        </a>
        <a href="{{ route('admin.inquiries.index', ['filter' => 'accepted']) }}"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request('filter') === 'accepted' ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Tenants</span>
        </a>
        <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.payments.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Payment</span>
        </a>
        <a href="{{ route('admin.maintenance.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.maintenance.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
            <span class="font-semibold">Maintenance Request</span>
        </a>

        <div x-data="{ open: {{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }} }">
            <button type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                <span class="font-semibold">Reports</span>
                <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" class="mt-1 ml-6 space-y-1">
                <a href="{{ route('admin.reports.index', ['tab' => 'tenants']) }}" class="flex items-center px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.reports.index') && request('tab') !== 'incoming' ? 'bg-blue-600/60 text-white' : 'text-blue-100 hover:bg-blue-700/50 hover:text-white' }}">
                    <span>To Tenants</span>
                </a>
                <a href="{{ route('admin.reports.index', ['tab' => 'incoming']) }}" class="flex items-center px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.reports.index') && request('tab') === 'incoming' ? 'bg-blue-600/60 text-white' : 'text-blue-100 hover:bg-blue-700/50 hover:text-white' }}">
                    <span>To Me</span>
                </a>
                <a href="{{ route('admin.reports.create') }}" class="flex items-center px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.reports.create') ? 'bg-blue-600/60 text-white' : 'text-blue-100 hover:bg-blue-700/50 hover:text-white' }}">
                    <span>Create</span>
                </a>
            </div>
        </div>
        <div x-data="{ openAgreements: {{ request()->routeIs('admin.agreements.*') ? 'true' : 'false' }} }">
            <button type="button" @click="openAgreements = !openAgreements"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.agreements.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                <span class="font-semibold">Lease Agreements</span>
                <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': openAgreements }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="openAgreements" class="mt-1 ml-6 space-y-1">
                <a href="{{ route('admin.agreements.index') }}" class="flex items-center px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.agreements.index') ? 'bg-blue-600/60 text-white' : 'text-blue-100 hover:bg-blue-700/50 hover:text-white' }}">
                    <span>From Super Admin</span>
                </a>
                <a href="{{ route('admin.agreements.tenants.index') }}" class="flex items-center px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.agreements.tenants.*') ? 'bg-blue-600/60 text-white' : 'text-blue-100 hover:bg-blue-700/50 hover:text-white' }}">
                    <span>To Tenants</span>
                </a>
            </div>
        </div>
        
        <!-- Logo Settings -->
        <a href="{{ route('admin.profile.logo.index') }}" 
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group text-blue-100 hover:bg-blue-700 hover:text-white {{ request()->routeIs('admin.profile.logo.index') ? 'bg-blue-600' : '' }}">
            <span class="font-semibold">Company Logo</span>
        </a>
    </nav>
</aside>

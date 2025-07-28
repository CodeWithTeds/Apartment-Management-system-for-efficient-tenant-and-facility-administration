<header class="flex items-center justify-between h-20 px-6 bg-white shadow-md">
    <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-500 rounded-md hover:bg-gray-100 focus:outline-none focus:ring">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>

    <div class="flex items-center">
        <div class="relative">
            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff" alt="avatar" class="w-10 h-10 rounded-full">
                <div>
                    <span class="block font-semibold">{{ auth()->user()->name }}</span>
                    <span class="block text-sm text-gray-500">TID: 12345</span>
                </div>
            </button>

            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl z-10">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                this.closest('form').submit();"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Logout
                    </a>
                </form>
            </div>
        </div>
    </div>
</header> 
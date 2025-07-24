<x-superadmin-layout>
    <div class="flex items-center justify-center min-h-screen">
        <div class="p-8 space-y-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-center">Super Admin Dashboard</h1>

            <form method="POST" action="{{ route('superadmin.logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                    Logout
                </button>
            </form>
        </div>
    </div>
</x-superadmin-layout> 
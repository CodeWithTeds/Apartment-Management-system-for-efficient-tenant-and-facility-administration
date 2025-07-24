<x-superadmin-layout>
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex w-full max-w-4xl overflow-hidden bg-white rounded-lg shadow-lg">
            <!-- Form Section -->
            <div class="flex flex-col justify-center w-full p-12 lg:w-1/2">
              
                <div class="w-full max-w-sm mx-auto">
                    <h2 class="mb-8 text-4xl font-bold">Super Admin Login</h2>
                    <form method="POST" action="{{ route('superadmin.login') }}" class="space-y-6">
                        @csrf
                        @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                        <div>
                            <label for="email" class="text-sm font-medium text-gray-700">email</label>
                            <input id="email" type="email" name="email" required autofocus class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                            <input id="password" type="password" name="password" required class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <button type="submit" class="w-full px-4 py-3 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Image Section -->
            <div class="hidden lg:block lg:w-1/2">
                <img src="{{ asset('images/landing.png') }}" alt="Login Image" class="object-cover w-full h-full">
            </div>
        </div>
    </div>
</x-superadmin-layout> 
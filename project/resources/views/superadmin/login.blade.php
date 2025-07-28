<x-auth-layout>
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-4xl p-8 mx-auto bg-white rounded-lg shadow-xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Login Form -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-4xl font-bold text-center text-gray-800">Super Admin Login</h2>
                    
                    @if ($errors->any())
                        <div class="mt-4 text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('superadmin.login') }}" class="mt-8 space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="text-sm font-semibold text-gray-700">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full px-4 py-3 mt-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                            <input id="password" type="password" name="password" required
                                class="w-full px-4 py-3 mt-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" type="checkbox" name="remember"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full px-4 py-3 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Image -->
                <div class="hidden md:block">
                    <img src="{{ asset('images/demo.png') }}" alt="Login Image" class="object-cover w-full h-full rounded-lg">
                </div>
            </div>
        </div>
    </div>
</x-auth-layout> 
<x-admin-layout>
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Branding Settings</h2>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Company Logo</h3>
        
        @if (session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <p class="text-gray-600 mb-6">
            Your company logo will be displayed to your tenants. Upload a professional image to represent your brand.
        </p>

        <div class="flex items-center mb-6">
            <div class="mr-6">
                <p class="text-sm font-medium text-gray-700 mb-2">Current Logo:</p>
                <div class="w-32 h-32 bg-white rounded-lg border border-gray-200 flex items-center justify-center overflow-hidden">
                    @if(auth()->user()->logo_path)
                        <img src="{{ Storage::url(auth()->user()->logo_path) }}" alt="Company Logo" class="max-h-full max-w-full">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="Default Logo" class="max-h-full max-w-full">
                    @endif
                </div>
            </div>
            
            <div>
                <p class="text-sm font-medium text-gray-700 mb-2">Upload New Logo:</p>
                <form action="{{ route('admin.profile.logo.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="file" name="logo" id="logo" accept="image/jpeg,image/png,image/jpg,image/svg" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                        ">
                        @error('logo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Upload Logo
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <h4 class="text-md font-medium text-gray-900 mb-2">Logo Guidelines</h4>
            <ul class="list-disc pl-5 text-sm text-gray-600 space-y-1">
                <li>File formats: JPG, PNG, or SVG</li>
                <li>Maximum file size: 2MB</li>
                <li>Recommended dimensions: 200×200 pixels (square)</li>
                <li>Keep the logo professional and appropriate</li>
            </ul>
        </div>
    </div>
</x-admin-layout>

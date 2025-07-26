<div class="bg-white shadow-lg rounded-2xl p-8 mt-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Become a Property Owner</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('property-applications.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" id="full_name" name="full_name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email" id="email" name="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number (Optional)</label>
            <input type="text" id="phone_number" name="phone_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Property Name -->
        <div>
            <label for="property_name" class="block text-sm font-medium text-gray-700">Property Name</label>
            <input type="text" id="property_name" name="property_name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Property Address -->
        <div class="md:col-span-2">
            <label for="property_address" class="block text-sm font-medium text-gray-700">Property Address</label>
            <textarea id="property_address" name="property_address" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <!-- Description -->
        <div class="md:col-span-2">
            <label for="description" class="block text-sm font-medium text-gray-700">Property Description (Optional)</label>
            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>
        
        <!-- Document Upload -->
        <div class="md:col-span-2">
            <label for="document" class="block text-sm font-medium text-gray-700">Upload Document (e.g., Proof of Ownership)</label>
            <input type="file" id="document" name="document" required class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            <p class="mt-1 text-xs text-gray-500">PDF, DOC, DOCX, JPG, PNG up to 2MB.</p>
        </div>

        <div class="md:col-span-2 text-right">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Submit Application
            </button>
        </div>
    </form>
</div> 
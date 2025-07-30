<x-admin-layout>
    <div class="flex flex-col flex-1">
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold">Your Properties</h1>

            @if(session('success'))
                <div class="p-4 mt-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-6">
                <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 text-sm font-semibold text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Property Name
                                </th>
                                <th class="px-5 py-3 text-sm font-semibold text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Address
                                </th>
                                <th class="px-5 py-3 text-sm font-semibold text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($apartments as $apartment)
                                <tr>
                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $apartment->name }}</p>
                                    </td>
                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $apartment->address }}</p>
                                    </td>
                                    <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                        <a href="{{ route('admin.property.edit', $apartment) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-admin-layout>

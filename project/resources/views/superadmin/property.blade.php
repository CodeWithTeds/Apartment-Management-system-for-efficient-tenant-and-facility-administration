<x-superadmin-layout>
    <x-slot name="title">
        Property
    </x-slot>

    <main class="flex-1 p-6">
        <h2 class="mb-6 text-3xl font-bold">PROPERTY</h2>

        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="p-6 mb-6 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold">Properties</h3>
                <div class="relative">
                    <input type="text" placeholder="Search Property" class="w-64 px-4 py-2 border rounded-lg">
                    <svg class="absolute w-5 h-5 text-gray-400 right-3 top-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr class="text-left text-gray-600">
                        <th class="p-2">Apartment Name</th>
                        <th class="p-2">Property Owner</th>
                        <th class="p-2">Total Units</th>
                        <th class="p-2">Occupied</th>
                        <th class="p-2">Available</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apartments as $apartment)
                        <tr class="border-t">
                            <td class="p-2">{{ $apartment->name }}</td>
                            <td class="p-2">{{ $apartment->owner->name ?? 'N/A' }}</td>
                            <td class="p-2">{{ $apartment->total_units }}</td>
                            <td class="p-2">{{ $apartment->total_units - $apartment->available_units }}</td>
                            <td class="p-2">{{ $apartment->available_units }}</td>
                            <td class="p-2 text-green-500">{{ $apartment->status }}</td>
                            <td class="flex p-2 space-x-2">
                                <a href="{{ route('superadmin.property.show', $apartment) }}" class="text-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('superadmin.property.edit', $apartment) }}" class="text-yellow-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <form action="{{ route('superadmin.property.destroy', $apartment) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('superadmin.property.create') }}" class="px-6 py-2 font-semibold text-white bg-blue-600 rounded-lg">
                ADD PROPERTY
            </a>
        </div>
    </main>
</x-superadmin-layout> 
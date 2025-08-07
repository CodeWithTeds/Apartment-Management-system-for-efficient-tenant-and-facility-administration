<x-superadmin-layout>
    <x-slot name="title">
        Report Details
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Report Details</h2>
            
        </div>
    </div>
    @push('scripts')
    <script>
        document.getElementById('date_range').addEventListener('change', function () {
            if (this.value === 'custom') {
                document.getElementById('custom_date_range').style.display = 'block';
            } else {
                document.getElementById('custom_date_range').style.display = 'none';
            }
        });
    </script>
    @endpush
</x-superadmin-layout>


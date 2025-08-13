<x-tenant-layout>
    <x-slot name="title">Agreement</x-slot>

    <div class="max-w-5xl mx-auto px-4 md:px-6 py-6">
        <div class="bg-white shadow rounded-xl border border-gray-200">
            <div class="px-6 py-4 border-b">
                <h1 class="text-2xl font-bold tracking-tight">LEASE AGREEMENT</h1>
                <p class="text-sm text-gray-600">Landlord: {{ $agreement->admin->name ?? '—' }} | Tenant: {{ $agreement->tenant->name ?? '—' }} | Date: {{ $agreement->created_at->format('M d, Y') }}</p>
            </div>

            <div class="px-6 py-6 space-y-6">
                <section>
                    <h2 class="font-semibold mb-2">Lease/Rent</h2>
                    <p class="text-gray-700 leading-relaxed">{!! nl2br(e($agreement->content)) !!}</p>
                </section>

                <section>
                    <h2 class="font-semibold mb-2">Terms</h2>
                    <p class="text-gray-700 leading-relaxed">This agreement outlines the terms and conditions for occupying the rental property. By viewing, the tenant acknowledges having access to the terms provided by the landlord.</p>
                </section>

                <section>
                    <h2 class="font-semibold mb-2">Signatures</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6">
                        <div>
                            <div class="h-16 border-b"></div>
                            <p class="mt-2 text-sm">Landlord Signature</p>
                        </div>
                        <div>
                            <div class="h-16 border-b"></div>
                            <p class="mt-2 text-sm">Tenant Signature</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-tenant-layout>



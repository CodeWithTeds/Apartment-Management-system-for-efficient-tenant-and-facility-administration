<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        $requests = MaintenanceRequest::where('tenant_id', Auth::id())
            ->latest('requested_at')
            ->latest()
            ->get();

        return view('tenant.maintenance.index', [
            'requests' => $requests,
        ]);
    }

    public function create()
    {
        return view('tenant.maintenance.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'unit_id' => ['nullable', 'exists:units,id'],
        ]);

        $maintenance = MaintenanceRequest::create([
            'unit_id' => $validated['unit_id'] ?? null,
            'tenant_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => 'Pending',
            'requested_at' => now(),
        ]);

        return redirect()->route('tenant.maintenance.index')
            ->with('success', 'Maintenance request submitted successfully.');
    }
}



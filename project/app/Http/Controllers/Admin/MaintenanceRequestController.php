<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as HttpRequest;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        // Basic listing for now; can be scoped by admin later if needed
        $requests = MaintenanceRequest::latest('requested_at')->latest()->get();

        return view('admin.maintenance.index', [
            'requests' => $requests,
        ]);
    }

    public function update(HttpRequest $request, MaintenanceRequest $maintenance_request)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Pending,In progress,Completed']
        ]);

        $maintenance_request->status = $validated['status'];
        // Mark completed_at when moving to Completed, otherwise null it
        if ($validated['status'] === 'Completed') {
            $maintenance_request->completed_at = now();
        } else {
            $maintenance_request->completed_at = null;
        }
        $maintenance_request->viewed_by_admin = now();
        $maintenance_request->save();

        return back()->with('success', 'Status updated.');
    }
}



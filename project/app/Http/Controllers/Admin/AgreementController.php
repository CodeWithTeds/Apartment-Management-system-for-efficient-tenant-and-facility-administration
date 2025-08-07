<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::with(['superAdmin', 'admin'])
            ->where('admin_id', Auth::id())
            ->latest()
            ->paginate(10);
        
        return view('admin.agreements.index', compact('agreements'));
    }

    public function show(Agreement $agreement)
    {
        // Ensure the admin can only view their own agreements
        if ($agreement->admin_id !== Auth::id()) {
            abort(403);
        }

        $agreement->load(['superAdmin', 'admin']);
        return view('admin.agreements.show', compact('agreement'));
    }

    public function acknowledge(Request $request, Agreement $agreement)
    {
        // Ensure the admin can only acknowledge their own agreements
        if ($agreement->admin_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'admin_notes' => 'nullable|string',
        ]);

        $agreement->update([
            'admin_acknowledged_at' => now(),
            'admin_notes' => $request->admin_notes,
            'status' => 'approved',
        ]);

        return redirect()->route('admin.agreements.index')
            ->with('success', 'Agreement acknowledged successfully.');
    }

    public function reject(Request $request, Agreement $agreement)
    {
        // Ensure the admin can only reject their own agreements
        if ($agreement->admin_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'admin_notes' => 'required|string',
        ]);

        $agreement->update([
            'admin_notes' => $request->admin_notes,
            'status' => 'rejected',
        ]);

        return redirect()->route('admin.agreements.index')
            ->with('success', 'Agreement rejected successfully.');
    }
}

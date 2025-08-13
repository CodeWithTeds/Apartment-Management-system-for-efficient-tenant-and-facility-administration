<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TenantReportController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'tenants');

        $tenantReports = collect();
        $incomingReports = collect();

        if ($tab === 'incoming') {
            $incomingReports = Report::where('channel', Report::CHANNEL_SUPERADMIN_TO_ADMIN)
                ->where('assignable_type', User::class)
                ->where('assignable_id', Auth::id())
                ->latest('created_at')
                ->get();
        } else {
            $tenantReports = Report::where('assignable_type', User::class)
                ->where('channel', Report::CHANNEL_ADMIN_TO_TENANT)
                ->with(['assignable'])
                ->latest('created_at')
                ->get();
        }

        return view('admin.reports.index', compact('tenantReports', 'incomingReports', 'tab'));
    }

    public function create()
    {
        $tenants = User::where('role', 'tenant')->orderBy('name')->get();
        return view('admin.reports.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => ['required', 'exists:users,id'],
            'report_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'file' => ['nullable', 'file', 'mimes:pdf,csv,txt,png,jpg,jpeg', 'max:20480'],
        ]);

        $filePath = null;
        $format = null;

        if ($request->hasFile('file')) {
            $uploaded = $request->file('file');
            $format = $uploaded->getClientOriginalExtension();
            $stored = $uploaded->store('reports', 'public');
            $filePath = 'storage/' . $stored; // web-accessible path
        }

        Report::create([
            'report_name' => $validated['report_name'],
            'report_type' => 'tenant',
            'date_range' => 'custom',
            'start_date' => null,
            'end_date' => null,
            'description' => $validated['description'] ?? null,
            'format' => $format ?? 'file',
            'status' => 'completed',
            'file_path' => $filePath,
            'completed_at' => now(),
            'assignable_id' => $validated['tenant_id'],
            'assignable_type' => User::class,
            'channel' => Report::CHANNEL_ADMIN_TO_TENANT,
        ]);

        return redirect()->route('admin.reports.index')->with('success', 'Report uploaded and assigned to tenant.');
    }
}



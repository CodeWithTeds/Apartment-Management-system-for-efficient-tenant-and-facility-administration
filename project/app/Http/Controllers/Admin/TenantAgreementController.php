<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantAgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::with(['tenant'])
            ->where('channel', 'admin_to_tenant')
            ->where('admin_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('admin.agreements.tenants.index', compact('agreements'));
    }

    public function create()
    {
        $tenants = User::where('role', 'tenant')->orderBy('name')->get();
        return view('admin.agreements.tenants.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'tenant_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'in:draft,pending'],
        ]);

        Agreement::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'admin_id' => Auth::id(),
            'tenant_id' => $validated['tenant_id'],
            'status' => $validated['status'],
            'channel' => 'admin_to_tenant',
        ]);

        return redirect()->route('admin.agreements.tenants.index')
            ->with('success', 'Tenant agreement created successfully.');
    }
}



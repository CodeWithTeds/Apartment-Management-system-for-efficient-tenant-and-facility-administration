<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::with(['superAdmin', 'admin'])
            ->where('super_admin_id', Auth::guard('superadmin')->id())
            ->latest()
            ->paginate(10);
        
        return view('superadmin.agreements.index', compact('agreements'));
    }

    public function create()
    {
        $admins = User::whereIn('role', ['owner', 'admin'])->get();
        return view('superadmin.agreements.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'admin_id' => 'required|exists:users,id',
            'status' => 'required|in:draft,pending',
        ]);

        Agreement::create([
            'title' => $request->title,
            'content' => $request->content,
            'super_admin_id' => Auth::guard('superadmin')->id(),
            'admin_id' => $request->admin_id,
            'status' => $request->status,
        ]);

        return redirect()->route('superadmin.agreements.index')
            ->with('success', 'Agreement created successfully.');
    }

    public function show(Agreement $agreement)
    {
        $agreement->load(['superAdmin', 'admin']);
        return view('superadmin.agreements.show', compact('agreement'));
    }

    public function edit(Agreement $agreement)
    {
        $admins = User::whereIn('role', ['owner', 'admin'])->get();
        return view('superadmin.agreements.edit', compact('agreement', 'admins'));
    }

    public function update(Request $request, Agreement $agreement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'admin_id' => 'required|exists:users,id',
            'status' => 'required|in:draft,pending,approved,rejected',
        ]);

        $agreement->update([
            'title' => $request->title,
            'content' => $request->content,
            'admin_id' => $request->admin_id,
            'status' => $request->status,
        ]);

        return redirect()->route('superadmin.agreements.index')
            ->with('success', 'Agreement updated successfully.');
    }

    public function destroy(Agreement $agreement)
    {
        $agreement->delete();
        return redirect()->route('superadmin.agreements.index')
            ->with('success', 'Agreement deleted successfully.');
    }
}

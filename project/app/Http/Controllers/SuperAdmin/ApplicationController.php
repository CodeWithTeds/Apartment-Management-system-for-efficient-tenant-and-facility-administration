<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyApplication;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = PropertyApplication::latest()->paginate(10);
        return view('superadmin.applications.index', compact('applications'));
    }

    public function show(PropertyApplication $application)
    {
        return view('superadmin.applications.show', compact('application'));
    }

    public function update(Request $request, PropertyApplication $application)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $application->update([
            'application_status' => $request->status,
        ]);

        // You might want to send an email to the applicant here

        return redirect()->route('superadmin.applications.index')->with('success', 'Application status updated successfully.');
    }
}

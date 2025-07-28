<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyApplication;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationApprovedMail;

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

        if ($request->status == 'approved' && $application->application_status != 'approved') {
            $password = Str::random(12);
            
            $user = User::firstOrCreate(
                ['email' => $application->email],
                [
                    'name' => $application->full_name,
                    'password' => Hash::make($password),
                ]
            );

            // Assign a role to the user, e.g., 'owner'
            // $user->assignRole('owner'); // Uncomment and adjust if you have a role system

            // Check if the user was just created to decide whether to send the email
            if ($user->wasRecentlyCreated) {
                Mail::to($user->email)->send(new ApplicationApprovedMail($user, $password));
            }
        }

        $application->update([
            'application_status' => $request->status,
        ]);

        return redirect()->route('superadmin.applications.index')->with('success', 'Application status updated successfully.');
    }

    public function destroy(PropertyApplication $application)
    {
        $application->delete();

        return redirect()->route('superadmin.applications.index')->with('success', 'Application deleted successfully.');
    }
}

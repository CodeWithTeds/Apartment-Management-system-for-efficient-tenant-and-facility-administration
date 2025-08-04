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

use Illuminate\Support\Facades\Log;

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
            $userData = [
                'name' => $application->full_name,
                'password' => Hash::make($password),
                'role' => 'owner',
            ];

            Log::info('Creating or updating user', ['email' => $application->email, 'data' => $userData]);

            $user = User::updateOrCreate(
                ['email' => $application->email],
                $userData
            );

            Mail::to($user->email)->send(new ApplicationApprovedMail($user, $password));
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

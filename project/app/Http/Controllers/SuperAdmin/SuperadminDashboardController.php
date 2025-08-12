<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Unit;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Agreement;
use App\Models\Inquiry;
use App\Models\Payment;
use App\Models\Report;
use App\Models\PropertyApplication;
use App\Models\SuperAdmin;

class SuperadminDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $totalProperties = Apartment::count();
        $totalUnits = Unit::count();
        $totalTenants = User::where('role', 'tenant')->count();
        $totalAdmins = User::where('role', 'owner')->count();

        $apartments = Apartment::all();

        $subscriptions = Subscription::with('user')->get();

        return view('superadmin.dashboard', compact('totalProperties', 'totalUnits', 'totalTenants', 'totalAdmins', 'apartments', 'subscriptions'));
    }

    public function showAllData()
    {
        // Get all data from all tables
        $data = [
            'apartments' => Apartment::with(['admin'])->get(),
            'units' => Unit::with(['user'])->get(),
            'users' => User::all(),
            'subscriptions' => Subscription::with('user')->get(),
            'agreements' => Agreement::with(['tenant', 'unit'])->get(),
            'inquiries' => Inquiry::all(),
            'payments' => Payment::with(['user', 'subscription'])->get(),
            'reports' => Report::all(),
            'propertyApplications' => PropertyApplication::all(),
            'superAdmins' => SuperAdmin::all(),
        ];

        return view('superadmin.all-data', compact('data'));
    }

    public function apiAllData()
    {
        // Return all data as JSON for API consumption
        $data = [
            'apartments' => Apartment::with(['admin'])->get(),
            'units' => Unit::with(['user'])->get(),
            'users' => User::all(),
            'subscriptions' => Subscription::with('user')->get(),
            'agreements' => Agreement::with(['tenant', 'unit'])->get(),
            'inquiries' => Inquiry::all(),
            'payments' => Payment::with(['user', 'subscription'])->get(),
            'reports' => Report::all(),
            'propertyApplications' => PropertyApplication::all(),
            'superAdmins' => SuperAdmin::all(),
        ];

        return response()->json($data);    }
}
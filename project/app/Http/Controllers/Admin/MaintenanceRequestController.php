<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use Illuminate\Support\Facades\Auth;

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
}



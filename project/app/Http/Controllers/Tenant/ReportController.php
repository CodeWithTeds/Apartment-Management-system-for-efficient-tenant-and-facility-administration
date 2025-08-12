<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('assignable_type', \App\Models\User::class)
            ->where('assignable_id', Auth::id())
            ->latest('created_at')
            ->get();

        return view('tenant.reports.index', compact('reports'));
    }
}



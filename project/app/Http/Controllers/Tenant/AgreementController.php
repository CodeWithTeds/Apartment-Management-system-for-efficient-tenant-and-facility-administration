<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use Illuminate\Support\Facades\Auth;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::query()
            ->where('channel', 'admin_to_tenant')
            ->where('tenant_id', Auth::id())
            ->latest()
            ->get();

        return view('tenant.agreements.index', compact('agreements'));
    }

    public function show(Agreement $agreement)
    {
        if ($agreement->tenant_id !== Auth::id()) {
            abort(403);
        }

        return view('tenant.agreements.show', compact('agreement'));
    }
}



<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $payments = Payment::where('tenant_id', $userId)->latest()->get();
        $pendingPayment = Payment::where('tenant_id', $userId)->where('status', 'pending')->latest()->first();

        return view('tenant.payments.index', [
            'payments' => $payments,
            'pendingPayment' => $pendingPayment,
        ]);
    }
}



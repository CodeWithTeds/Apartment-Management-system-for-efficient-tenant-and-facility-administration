<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Services\PayMongoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $payMongoService;

    public function __construct(PayMongoService $payMongoService)
    {
        $this->payMongoService = $payMongoService;
    }

    public function index()
    {
        $payments = Payment::where('property_owner_id', Auth::id())->with('tenant')->latest()->get();

        $stats = [
            'total_payments' => $payments->count(),
            'total_paid' => $payments->where('status', 'paid')->sum('amount'),
            'total_pending' => $payments->where('status', 'pending')->sum('amount'),
        ];

        return view('admin.payments.index', compact('payments', 'stats'));
    }

    public function create()
    {
        $tenants = User::where('role', 'tenant')->get();
        return view('admin.payments.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $data = $request->all();
        $data['property_owner_id'] = Auth::id();

        $payment = Payment::create($data);

        $paymentLink = $this->payMongoService->createCheckoutSession($payment);

        if ($paymentLink) {
            $payment->update(['payment_link' => $paymentLink]);
            return redirect()->route('admin.payments.index')->with('success', 'Payment link generated successfully.');
        }

        $payment->delete();
        return back()->with('error', 'Could not create PayMongo payment link. Please check application logs for more details.');
    }
}

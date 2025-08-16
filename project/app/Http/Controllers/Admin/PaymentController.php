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
        $payments = Payment::where(function($query) {
            // Get payments where the current user is the property owner
            $query->where('property_owner_id', Auth::id());
            
            // Or where the agreement belongs to the current user
            $query->orWhereHas('agreement', function ($q) {
                $q->where('admin_id', Auth::id());
            });
        })
        ->with(['tenant', 'agreement.tenant'])
        ->latest()
        ->get();

        $stats = [
            'total_payments' => $payments->count(),
            'total_paid' => $payments->where('status', 'paid')->sum('amount'),
            'total_pending' => $payments->where('status', 'pending')->sum('amount'),
        ];
        
        // Load properties with bill settings
        $properties = Apartment::where('admin_id', Auth::id())->get();

        return view('admin.payments.index', compact('payments', 'stats', 'properties'));
    }

    public function create()
    {
        // Get tenants who have inquiries for apartments owned by the current admin
        $tenants = User::where('role', 'tenant')
            ->whereHas('agreementsAsTenant', function ($query) {
                $query->where('admin_id', Auth::id())
                    ->where('status', 'active');
            })
            ->orWhereExists(function ($query) {
                $query->select('inquiries.id')
                    ->from('inquiries')
                    ->join('apartments', 'inquiries.apartment_id', '=', 'apartments.id')
                    ->whereColumn('inquiries.email', 'users.email')
                    ->where('apartments.admin_id', Auth::id())
                    ->where('inquiries.status', 'accepted');
            })
            ->get();

        $billTypes = ['rent', 'water', 'electric'];
        return view('admin.payments.create', compact('tenants', 'billTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'bill_type' => 'required|in:rent,water,electric',
        ]);

        $tenant = User::find($request->tenant_id);
        
        // Try to find an agreement
        $agreement = $tenant->agreementsAsTenant()->where('admin_id', Auth::id())->first();
        
        // If no agreement exists, create a basic data array
        $data = $request->all();
        $data['tenant_id'] = $tenant->id;
        $data['property_owner_id'] = Auth::id();
        $data['balance'] = $request->amount;
        $data['status'] = 'pending';
        
        // If agreement exists, add it to the data
        if ($agreement) {
            $data['agreement_id'] = $agreement->id;
        }

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

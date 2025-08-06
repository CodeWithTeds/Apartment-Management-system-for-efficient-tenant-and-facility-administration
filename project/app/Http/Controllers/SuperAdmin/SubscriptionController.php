<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Services\PayMongoService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $payMongoService;

    public function __construct(PayMongoService $payMongoService)
    {
        $this->payMongoService = $payMongoService;
    }
    public function index(Request $request)
    {
        $query = Subscription::with('user')->latest();
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $subscriptions = $query->paginate(10);
        
        return view('superadmin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $users = User::all();
        return view('superadmin.subscriptions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:users,id',
            'billing_email' => 'required|email',
            'subscription_plan' => 'required|in:basic,premium,enterprise,standard',
            'billing_cycle' => 'required|in:monthly,quarterly,annually',
            'start_date' => 'required|date',
            'amount' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $startDate = \Carbon\Carbon::parse($data['start_date']);

        $data['renewal_date'] = match ($data['billing_cycle']) {
            'monthly' => $startDate->addMonth(),
            'quarterly' => $startDate->addMonths(3),
            'annually' => $startDate->addYear(),
        };

        $data['payment_method'] = 'gcash';
        $data['payment_status'] = 'pending';

        $subscription = Subscription::create($data);

        $paymentLink = $this->payMongoService->createCheckoutSession($subscription);

        if ($paymentLink) {
            // Store the payment link directly in the payment_link field
            $subscription->update([
                'payment_link' => $paymentLink
            ]);
            
            return redirect()->route('superadmin.subscriptions.index')->with('success', 'Subscription created successfully. Payment link: ' . $paymentLink);
        }
        
        $subscription->delete();
        return back()->with('error', 'Could not create PayMongo payment link. Please check the application logs for more details.');
    }

    public function show(Subscription $subscription)
    {
        return view('superadmin.subscriptions.show', compact('subscription'));
    }

    public function edit(Subscription $subscription)
    {
        return view('superadmin.subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'status' => 'required|in:Active,Suspended,Cancelled',
            'payment_status' => 'required|in:paid,pending,failed,refunded',
        ]);

        $subscription->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('superadmin.subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('superadmin.subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}

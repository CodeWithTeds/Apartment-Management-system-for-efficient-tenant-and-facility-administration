<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscription::with('user')->latest();
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $subscriptions = $query->paginate(10);
        
        // Handle payment success/cancel and update payment status automatically
        if ($request->has('payment_success') && $request->has('subscription_id')) {
            $subscription = Subscription::find($request->subscription_id);
            if ($subscription) {
                $subscription->update(['payment_status' => 'paid']);
                return redirect()->route('superadmin.subscriptions.index')
                    ->with('success', 'Payment successful! The subscription has been marked as paid.');
            }
        } elseif ($request->has('payment_cancelled') && $request->has('subscription_id')) {
            $subscription = Subscription::find($request->subscription_id);
            if ($subscription) {
                $subscription->update(['payment_status' => 'failed']);
                return redirect()->route('superadmin.subscriptions.index')
                    ->with('error', 'Payment was cancelled. The subscription has been marked as failed.');
            }
        }
        
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

        $paymentLink = $this->paymongo($subscription);

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

    private function paymongo(Subscription $subscription)
    {
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(config('services.paymongo.secret_key') . ':'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://api.paymongo.com/v1/checkout_sessions', [
            'data' => [
                'attributes' => [
                    'billing' => [
                        'name' => $subscription->user->name,
                        'email' => $subscription->billing_email,
                    ],
                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' => $subscription->amount * 100,
                            'name' => $subscription->subscription_plan . ' Subscription',
                            'quantity' => 1,
                        ]
                    ],
                    'payment_method_types' => ['gcash'],
                    'description' => 'Subscription for ' . $subscription->subscription_plan,
                    'success_url' => route('superadmin.subscriptions.index') . '?payment_success=true&subscription_id=' . $subscription->id,
                    'cancel_url' => route('superadmin.subscriptions.index') . '?payment_cancelled=true&subscription_id=' . $subscription->id,
                ],
            ],
        ]);

        if ($response->successful() && isset($response->json()['data']['attributes']['checkout_url'])) {
            return $response->json()['data']['attributes']['checkout_url'];
        }

        \Illuminate\Support\Facades\Log::error('PayMongo API Error: ' . $response->body());
        return null;
    }
}

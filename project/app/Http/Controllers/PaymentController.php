<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        $subscription = Subscription::find($request->subscription_id);

        if ($subscription) {
            $subscription->update(['payment_status' => 'paid']);
            return redirect()->route('dashboard')->with('success', 'Payment successful! Your subscription is now active.');
        }

        return redirect()->route('dashboard')->with('error', 'Subscription not found.');
    }

    public function cancel(Request $request)
    {
        $subscription = Subscription::find($request->subscription_id);

        if ($subscription) {
            $subscription->update(['payment_status' => 'failed']);
            return redirect()->route('dashboard')->with('error', 'Payment was cancelled.');
        }

        return redirect()->route('dashboard')->with('error', 'Subscription not found.');
    }
}

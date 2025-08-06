<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        if ($request->has('subscription_id')) {
            $subscription = Subscription::find($request->subscription_id);

            if ($subscription) {
                $subscription->update(['payment_status' => 'paid']);
                return redirect()->route('dashboard')->with('success', 'Payment successful! Your subscription is now active.');
            }
        }

        if ($request->has('payment_id')) {
            $payment = Payment::find($request->payment_id);

            if ($payment) {
                $payment->update(['status' => 'paid']);
                return redirect()->route('admin.payments.index')->with('success', 'Payment successful!');
            }
        }

        return redirect()->route('dashboard')->with('error', 'Payment record not found.');
    }

    public function cancel(Request $request)
    {
        if ($request->has('subscription_id')) {
            $subscription = Subscription::find($request->subscription_id);

            if ($subscription) {
                $subscription->update(['payment_status' => 'failed']);
                return redirect()->route('dashboard')->with('error', 'Payment was cancelled.');
            }
        }

        if ($request->has('payment_id')) {
            $payment = Payment::find($request->payment_id);

            if ($payment) {
                $payment->update(['status' => 'failed']);
                return redirect()->route('admin.payments.index')->with('error', 'Payment was cancelled.');
            }
        }

        return redirect()->route('dashboard')->with('error', 'Payment record not found.');
    }
}

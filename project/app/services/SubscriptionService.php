<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class SubscriptionService
{
    public function hasPendingPayment()
    {
        $user = Auth::user();

        if ($user && $user->subscription && $user->subscription->payment_status === 'pending') {
            return true;
        }

        return false;
    }
}

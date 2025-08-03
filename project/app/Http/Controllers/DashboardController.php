<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $hasPendingPayment = $user->subscription && $user->subscription->payment_status === 'pending';
        $properties = $user->properties;

        return view('dashboard', [
            'hasPendingPayment' => $hasPendingPayment,
            'properties' => $properties
        ]);
    }
}

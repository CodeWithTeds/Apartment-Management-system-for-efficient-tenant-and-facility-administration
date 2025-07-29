<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function __invoke()
    {
        $hasPendingPayment = $this->subscriptionService->hasPendingPayment();
        $properties = auth()->user()->properties;

        return view('dashboard', [
            'hasPendingPayment' => $hasPendingPayment,
            'properties' => $properties
        ]);
    }
}

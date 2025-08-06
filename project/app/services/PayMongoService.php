<?php

namespace App\Services;

use App\Models\Subscription;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PayMongoService
{
    public function createCheckoutSession($payable)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(config('services.paymongo.secret_key') . ':'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://api.paymongo.com/v1/checkout_sessions', [
            'data' => [
                'attributes' => [
                    'billing' => [
                        'name' => $payable->getPayableName(),
                        'email' => $payable->getPayableEmail(),
                    ],
                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' => $payable->getPayableAmount() * 100,
                            'name' => $payable->getPayableDescription(),
                            'quantity' => 1,
                        ]
                    ],
                    'payment_method_types' => ['gcash'],
                    'description' => $payable->getPayableDescription(),
                    'success_url' => $payable->getSuccessUrl(),
                    'cancel_url' => $payable->getCancelUrl(),
                ],
            ],
        ]);

        if ($response->successful() && isset($response->json()['data']['attributes']['checkout_url'])) {
            return $response->json()['data']['attributes']['checkout_url'];
        }

        Log::error('PayMongo API Error: ' . $response->body());
        return null;
    }
}

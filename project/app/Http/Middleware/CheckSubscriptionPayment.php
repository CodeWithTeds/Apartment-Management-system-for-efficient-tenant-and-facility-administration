<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscriptionPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->subscription && $user->subscription->payment_status === 'pending') {
            return redirect()->route('dashboard')->with('error', 'Your subscription payment is pending. Please complete the payment to continue.');
        }

        return $next($request);
    }
}

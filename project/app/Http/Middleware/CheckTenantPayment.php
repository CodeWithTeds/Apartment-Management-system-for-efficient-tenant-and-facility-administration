<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTenantPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === 'tenant') {
            // Check if tenant has any payments with status 'paid'
            $hasPaidPayment = $user->payments()->where('status', 'paid')->exists();
            
            if (!$hasPaidPayment) {
                // If no paid payments, redirect to payment required page
                return redirect()->route('tenant.payment.required');
            }
        }

        return $next($request);
    }
}

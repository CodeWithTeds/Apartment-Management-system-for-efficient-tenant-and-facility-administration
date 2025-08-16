<?php

namespace App\Http\View\Composers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Inquiry;
use App\Models\Unit;

class TenantLogoComposer
{
    /**
     * Share logo data with the view.
     */
    public function compose(View $view)
    {
        if (Auth::check() && Auth::user()->role === 'tenant') {
            /** @var \App\Models\User $tenant */
            $tenant = Auth::user();
            $ownerLogo = null;

            // Try to get the logo from the tenant's agreement
            if ($tenant->agreementAsTenant && $tenant->agreementAsTenant->admin) {
                $ownerLogo = $tenant->agreementAsTenant->admin->logo_path;
            }

            // If no logo found through agreement, try to find through payment
            if (!$ownerLogo) {
                $payment = $tenant->payments()->with('propertyOwner')->latest()->first();
                if ($payment && $payment->propertyOwner) {
                    $ownerLogo = $payment->propertyOwner->logo_path;
                }
            }

            // If still no logo, try to find through inquiry
            if (!$ownerLogo) {
                $inquiry = Inquiry::where('email', $tenant->email)
                    ->with('apartment.owner')
                    ->latest()
                    ->first();
                
                if ($inquiry && $inquiry->apartment && $inquiry->apartment->owner) {
                    $ownerLogo = $inquiry->apartment->owner->logo_path;
                }
            }

            $view->with('ownerLogo', $ownerLogo);
        }
    }
}

<?php

namespace App\Http\View\Composers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TenantLogoComposer
{
    /**
     * Share logo data with the view.
     */
    public function compose(View $view)
    {
        if (Auth::check() && Auth::user()->role === 'tenant') {
            // Get current tenant
            $tenant = Auth::user();
            
            // Get properties this tenant has inquired about through units
            $unit = \App\Models\Unit::whereHas('inquiry', function($query) use ($tenant) {
                $query->where('email', $tenant->email);
            })->first();
            
            if ($unit && $unit->apartment && $unit->apartment->owner) {
                $ownerLogo = $unit->apartment->owner->logo_path;
                $view->with('ownerLogo', $ownerLogo);
            }
        }
    }
}

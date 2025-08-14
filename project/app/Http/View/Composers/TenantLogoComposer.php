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

            if ($tenant->agreementAsTenant && $tenant->agreementAsTenant->admin) {
                $ownerLogo = $tenant->agreementAsTenant->admin->logo_path;
                $view->with('ownerLogo', $ownerLogo);
            }
        }
    }
}

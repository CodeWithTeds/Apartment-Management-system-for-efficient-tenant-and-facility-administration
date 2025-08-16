<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLogoComposer
{
    /**
     * Share logo data with the view.
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            // Check if the user has a logo_path
            if ($user->logo_path) {
                $view->with('adminLogo', $user->logo_path);
            }
        }
    }
}

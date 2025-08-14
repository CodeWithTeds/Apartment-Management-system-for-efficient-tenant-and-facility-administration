<?php

namespace App\Providers;

use App\Http\View\Composers\TenantLogoComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register view composers
        View::composer([
            'tenant.partials.sidebar',
            'tenant.dashboard'
        ], TenantLogoComposer::class);
    }
}

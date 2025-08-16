<?php

namespace App\Providers;

use App\Http\View\Composers\AdminLogoComposer;
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
            'tenant.dashboard',
            'layouts.tenant'
        ], TenantLogoComposer::class);
        
        View::composer([
            'admin.partials.sidebar',
            'layouts.admin'
        ], AdminLogoComposer::class);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Models\Apartment;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\SuperAdmin\ApartmentController as SuperAdminApartmentController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\MaintenanceRequestController as AdminMaintenanceRequestController;
use App\Http\Controllers\Admin\TenantReportController as AdminTenantReportController;
use App\Http\Controllers\Tenant\PaymentController as TenantPaymentController;
use App\Http\Controllers\Tenant\MaintenanceRequestController as TenantMaintenanceRequestController;
use App\Http\Controllers\SuperAdmin\ReportController;
use App\Http\Controllers\SuperAdmin\AgreementController;
use App\Http\Controllers\Admin\AgreementController as AdminAgreementController;
use App\Http\Controllers\Admin\TenantAgreementController as AdminTenantAgreementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', LandingController::class);
Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartment.show');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Payment routes
Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('become-a-property-owner', 'become-a-property-owner')->name('become-a-property-owner');

// SuperAdmin routes
Route::prefix('superadmin')->name('superadmin.')->group(function(){
    Route::get('/login', [App\Http\Controllers\SuperAdmin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\SuperAdmin\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\SuperAdmin\Auth\LoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [App\Http\Controllers\SuperAdmin\SuperadminDashboardController::class, '__invoke'])->middleware('auth:superadmin')->name('dashboard');
    Route::resource('property', App\Http\Controllers\SuperAdmin\PropertyController::class)->parameters(['property' => 'apartment'])->middleware('auth:superadmin');
    Route::resource('applications', App\Http\Controllers\SuperAdmin\ApplicationController::class)->middleware('auth:superadmin');
    Route::resource('subscriptions', App\Http\Controllers\SuperAdmin\SubscriptionController::class)->middleware('auth:superadmin');
    Route::resource('reports', ReportController::class)->middleware('auth:superadmin');
    Route::post('reports/{report}/generate', [ReportController::class, 'generate'])->name('reports.generate')->middleware('auth:superadmin');
    Route::resource('agreements', AgreementController::class)->middleware('auth:superadmin');
});

// Constrain route model binding for agreement ids
Route::pattern('agreement', '[0-9]+');

// Admin routes for property owners
Route::prefix('admin')->name('admin.')->middleware(['auth', 'check.subscription'])->group(function () {
    Route::resource('property', PropertyController::class)->parameters(['property' => 'apartment']);
    Route::resource('units', UnitController::class);
    Route::resource('payments', AdminPaymentController::class)->only(['index', 'create', 'store']);
    Route::get('maintenance', [AdminMaintenanceRequestController::class, 'index'])->name('maintenance.index');
    Route::patch('maintenance/{maintenance_request}', [AdminMaintenanceRequestController::class, 'update'])->name('maintenance.update');
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [AdminTenantReportController::class, 'index'])->name('index');
        Route::get('/create', [AdminTenantReportController::class, 'create'])->name('create');
        Route::post('/', [AdminTenantReportController::class, 'store'])->name('store');
    });
    // Admin -> Tenant agreements
    Route::prefix('agreements/tenants')->name('agreements.tenants.')->group(function () {
        Route::get('/', [AdminTenantAgreementController::class, 'index'])->name('index');
        Route::get('/create', [AdminTenantAgreementController::class, 'create'])->name('create');
        Route::post('/', [AdminTenantAgreementController::class, 'store'])->name('store');
    });

    Route::resource('inquiries', App\Http\Controllers\InquiryController::class)->only(['index', 'show', 'update']);
    Route::resource('agreements', AdminAgreementController::class)->only(['index', 'show']);
    Route::post('agreements/{agreement}/acknowledge', [AdminAgreementController::class, 'acknowledge'])->name('agreements.acknowledge');
    Route::post('agreements/{agreement}/reject', [AdminAgreementController::class, 'reject'])->name('agreements.reject');
});

// Register the middleware
Route::prefix('tenant')->name('tenant.')->middleware(['auth'])->group(function () {
    // Payment required route - accessible even without payments
    Route::get('/payment-required', function () {
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();
        $pendingPayment = $user->payments()->where('status', 'pending')->latest()->first();
        return view('tenant.payment-required', compact('pendingPayment'));
    })->name('payment.required');
    
    // Maintenance requests
    Route::get('/maintenance', [TenantMaintenanceRequestController::class, 'index'])->name('maintenance.index');
    Route::get('/maintenance/create', [TenantMaintenanceRequestController::class, 'create'])->name('maintenance.create');
    Route::post('/maintenance', [TenantMaintenanceRequestController::class, 'store'])->name('maintenance.store');

    // Routes that require payment
    Route::middleware('check.tenant.payment')->group(function () {
        Route::get('/payments', [TenantPaymentController::class, 'index'])->name('payments.index');
        Route::get('/agreements', [\App\Http\Controllers\Tenant\AgreementController::class, 'index'])->name('agreements.index');
        Route::get('/agreements/{agreement}', [\App\Http\Controllers\Tenant\AgreementController::class, 'show'])->name('agreements.show');
        Route::patch('/agreements/{agreement}', [\App\Http\Controllers\Tenant\AgreementController::class, 'update'])->name('agreements.update');
        Route::get('/reports', [\App\Http\Controllers\Tenant\ReportController::class, 'index'])->name('reports.index');
        Route::get('/dashboard', function () {
            /** @var \App\Models\User $user */
            $user = \Illuminate\Support\Facades\Auth::user();
            $payments = $user->payments()->latest()->get();
            $latestPayment = $payments->first();
            $paymentHistory = $payments->take(5);
            $maintenanceRequests = \App\Models\MaintenanceRequest::where('tenant_id', $user->id)
                ->latest('updated_at')
                ->take(3)
                ->get();
            $lastMaintenanceUpdateRaw = \App\Models\MaintenanceRequest::where('tenant_id', $user->id)
                ->max('updated_at');
            $lastMaintenanceUpdate = $lastMaintenanceUpdateRaw
                ? \Illuminate\Support\Carbon::parse($lastMaintenanceUpdateRaw)->timezone(config('app.timezone'))
                : null;
            
            return view('tenant.dashboard', [
                'payments' => $payments,
                'latestPayment' => $latestPayment,
                'paymentHistory' => $paymentHistory,
                'maintenanceRequests' => $maintenanceRequests,
                'lastMaintenanceUpdate' => $lastMaintenanceUpdate
            ]);
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
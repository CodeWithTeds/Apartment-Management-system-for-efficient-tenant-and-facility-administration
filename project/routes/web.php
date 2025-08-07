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
    Route::view('/dashboard', 'superadmin.dashboard')->middleware('auth:superadmin')->name('dashboard');
    Route::resource('property', App\Http\Controllers\SuperAdmin\PropertyController::class)->parameters(['property' => 'apartment'])->middleware('auth:superadmin');
    Route::resource('applications', App\Http\Controllers\SuperAdmin\ApplicationController::class)->middleware('auth:superadmin');
    Route::resource('subscriptions', App\Http\Controllers\SuperAdmin\SubscriptionController::class)->middleware('auth:superadmin');
    Route::resource('reports', App\Http\Controllers\SuperAdmin\ReportController::class)->middleware('auth:superadmin');
});

// Admin routes for property owners
Route::prefix('admin')->name('admin.')->middleware(['auth', 'check.subscription'])->group(function () {
    Route::resource('property', PropertyController::class)->parameters(['property' => 'apartment']);
    Route::resource('units', UnitController::class);
    Route::resource('payments', AdminPaymentController::class)->only(['index', 'create', 'store']);
    Route::resource('inquiries', App\Http\Controllers\InquiryController::class)->only(['index', 'show', 'update']);
});

Route::prefix('tenant')->name('tenant.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('tenant.dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Models\Apartment;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\SuperAdmin\ApartmentController as SuperAdminApartmentController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PaymentController;

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

Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

Route::get('/', LandingController::class);
Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartment.show');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('become-a-property-owner', 'become-a-property-owner')->name('become-a-property-owner');

Route::prefix('superadmin')->name('superadmin.')->group(function(){
    Route::get('/login', [App\Http\Controllers\SuperAdmin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\SuperAdmin\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\SuperAdmin\Auth\LoginController::class, 'logout'])->name('logout');
    Route::view('/dashboard', 'superadmin.dashboard')->middleware('auth:superadmin')->name('dashboard');
    Route::resource('property', App\Http\Controllers\SuperAdmin\PropertyController::class)->parameters(['property' => 'apartment'])->middleware('auth:superadmin');
    Route::resource('applications', App\Http\Controllers\SuperAdmin\ApplicationController::class)->middleware('auth:superadmin');
    Route::resource('subscriptions', App\Http\Controllers\SuperAdmin\SubscriptionController::class)->middleware('auth:superadmin');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('property', App\Http\Controllers\Admin\PropertyController::class)->parameters(['property' => 'apartment']);
});

require __DIR__.'/auth.php';

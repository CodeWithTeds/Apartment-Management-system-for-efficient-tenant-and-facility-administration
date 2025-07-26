<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Models\Apartment;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\SuperAdmin\ApartmentController as SuperAdminApartmentController;
use App\Http\Controllers\PropertyApplicationController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/become-a-property-owner', function () {
    return view('become-a-property-owner');
})->name('become-a-property-owner');

Route::post('/property-applications', [PropertyApplicationController::class, 'store'])->name('property-applications.store');
Route::get('/property-applications/verify/{token}', [PropertyApplicationController::class, 'verify'])->name('property-applications.verify');

// Test route for email verification (remove in production)
Route::get('/test-email/{email}', function($email) {
    $application = new \App\Models\PropertyApplication([
        'full_name' => 'Test User',
        'email' => $email,
        'verification_token' => 'test-token-123'
    ]);
    
    \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\VerifyPropertyApplicationMail($application));
    
    return 'Test email sent to ' . $email . '. Check your logs at storage/logs/laravel.log';
});

// Route for individual apartment view
Route::get('/apartment/{apartment}', [ApartmentController::class, 'show'])->name('apartment.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::prefix('superadmin')->name('superadmin.')->group(function(){
    Route::get('/login', [App\Http\Controllers\SuperAdmin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\SuperAdmin\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\SuperAdmin\Auth\LoginController::class, 'logout'])->name('logout');
    Route::view('/dashboard', 'superadmin.dashboard')->middleware('auth:superadmin')->name('dashboard');
    Route::resource('property', App\Http\Controllers\SuperAdmin\PropertyController::class)->parameters(['property' => 'apartment'])->middleware('auth:superadmin');
});


require __DIR__.'/auth.php';

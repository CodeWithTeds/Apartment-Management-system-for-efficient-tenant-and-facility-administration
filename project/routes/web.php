<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Models\Apartment;
use App\Http\Controllers\ApartmentController;

Route::get('/', function () {
    $apartments = Apartment::latest()->get();
    return view('landing', compact('apartments'));
})->name('home');

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

<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Models\Apartment;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\SuperAdmin\ApartmentController as SuperAdminApartmentController;

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

Route::view('/', 'landing');

Route::view('dashboard', 'dashboard')
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
});

require __DIR__.'/auth.php';

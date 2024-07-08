<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserLoginController;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\DriversLicenses;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/login', [UserLoginController::class, 'index'])
    ->name('user.login')
    ->middleware('guest'); 

/**
 * Employees Routes
 */

Route::get('/employee', function () {
    $customers = Customer::with('user')->get();
    return view('employee.index', compact('customers'));
})->name('employee.index');

/**
 * Drivers Routes
 */

Route::get('/driver', function () {
    $drivers = Driver::with('user')->get();
    return view('driver.index', compact('drivers'));
})->name('driver.index');

Route::get('/driver/license', function () {
    $licenses = DriversLicenses::get();
    return view('driver.license.index', compact('licenses'));
})->name('driver.license.index');

Route::get('/driver/performance', function () {
    return view('driver.performance.index');
})->middleware(['auth'])->name('driver.performance.index');

/**
 * Vehicles Routes
 */

Route::get('/vehicle', function () {
    $vehicles = Vehicle::with('driver')->get();
    return view('vehicle.index', compact('vehicles'));
})->name('vehicle.index');
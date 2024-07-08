<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserLoginController;
use App\Models\Customer;

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

Route::get('/file', [UserLoginController::class, 'file'])->name('file.file');

Route::get('/employee', function () {
    $customers = Customer::with('user')->get();
    return view('employee.index', compact('customers'));
})->name('employee.index');

Route::get('/employee/position', function () {
    return view('employee.position.index');
})->middleware(['auth'])->name('employee.position.index');

Route::get('/employee/department', function () {
    return view('employee.department.index');
})->middleware(['auth'])->name('employee.department.index');

/**
 * Drivers Routes
 */

Route::get('/driver', function () {
    return view('driver.index');
})->middleware(['auth'])->name('driver.index');

Route::get('/driver/license', function () {
    return view('driver.license.index');
})->middleware(['auth'])->name('driver.license.index');

Route::get('/driver/performance', function () {
    return view('driver.performance.index');
})->middleware(['auth'])->name('driver.performance.index');
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\OrganisationController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/login', [UserLoginController::class, 'index'])->name('user.login')->middleware('guest');

/**
 * Employees Routes
 * 
 */



Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::get('employee', [EmployeeController::class, 'index'])->name('employee');

Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::get('employee/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.destroy');
/**
 * Drivers Routes
 * 
 */


Route::get('driver', [DriverController::class, 'index'])->name('driver');

Route::get('driver/create', [DriverController::class, 'create'])->name('driver.create');
Route::get('driver/{id}/edit', [DriverController::class, 'edit'])->name('driver.edit');
Route::get('driver/{id}/delete', [DriverController::class, 'destroy'])->name('driver.destroy');

Route::get('driver/performance', [DriverController::class, 'create'])->name('driver.performance.index');
Route::get('driver/license', [DriverController::class, 'driverLicense'])->name('driver.license.index');

/**
 * Organisation Routes
 * 
 */
Route::get('organisation', [OrganisationController::class, 'index'])->name('organisation');

Route::get('organisation/create', [OrganisationController::class, 'create'])->name('organisation.create');
Route::get('organisation/{id}/edit', [OrganisationController::class, 'edit'])->name('organisation.edit');
Route::get('organisation/{id}/delete', [OrganisationController::class, 'destroy'])->name('organisation.destroy');

/**
 * 'Routes' Routes
 * 
 */

 Route::get('our-routes', [AddRouteController::class, , 'index'])->name('our.routes');

Route::get('routes/create', [AddRouteController::class, 'create'])->name('route.create');
Route::get('edit-route/{id}/edit', [AddRouteController::class, 'edit'])->name('route.edit');
Route::get('route-delete/{id}/delete', [AddRouteController::class, 'destroy'])->name('route.destroy');
/**
   * Tripes Routes
   * 
   */

Route::get('trips', [TripController::class, , , 'index'])->name('booked.trip');

Route::get('trip/create', [TripController::class, 'create'])->name('trip.create');
Route::get('trip/{id}/edit', [TripController::class, 'edit'])->name('trip.edit');
Route::get('trip/{id}/delete', [TripController::class, 'destroy'])->name('trip.destroy');
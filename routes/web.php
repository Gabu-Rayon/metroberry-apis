<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\VehicleServiceController;
use App\Http\Controllers\DriversLicensesController;
use App\Http\Controllers\VehicleInsuranceController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/login', [UserLoginController::class, 'index'])->name('user.login');

/**
 * Employees Routes
 * 
 */



Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::get('employee', [EmployeeController::class, 'index'])->name('employee');
Route::post('employee', [EmployeeController::class, 'store'])->name('employee');

Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::get('employee/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.destroy');

/***
 * Organisations Routes
 */
// organisation organisation/create
Route::get('organisation/create', [OrganisationController::class, 'create'])->name('organisation.create');
Route::get('organisation', [OrganisationController::class, 'index'])->name('organisation');

Route::get('organisation/{id}/edit', [OrganisationController::class, 'edit'])->name('organisation.edit');
Route::get('organisation/{id}/delete', [OrganisationController::class, 'destroy'])->name('organisation.destroy');
/**
 * Drivers Routes
 * 
 */


Route::get('driver', [DriverController::class, 'index'])->name('driver');

Route::get('driver/create', [DriverController::class, 'create'])->name('driver.create');
Route::post('driver', [EmployeeController::class, 'store'])->name('driver');
Route::get('driver/{id}/edit', [DriverController::class, 'edit'])->name('driver.edit');
Route::get('driver/{id}/delete', [DriverController::class, 'destroy'])->name('driver.destroy');

Route::get('driver/performance', [DriverController::class,'driverPerformance'])->name('driver.performance.index');
Route::get('performance/create', [DriverController::class, 'createDriverPerformance'])->name('driver.performance.create');
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

Route::get('our-routes', [AddRouteController::class, 'index'])->name('our.routes');

Route::get('routes/create', [AddRouteController::class, 'create'])->name('route.create');
Route::get('edit-route/{id}/edit', [AddRouteController::class, 'edit'])->name('route.edit');
Route::get('route-delete/{id}/delete', [AddRouteController::class, 'destroy'])->name('route.destroy');
/**
 * Tripes Routes
 * 
 */

Route::get('trips', [TripController::class, 'index'])->name('booked.trip');

Route::get('trip/create', [TripController::class, 'create'])->name('trip.create');
Route::get('trip/{id}/edit', [TripController::class, 'edit'])->name('trip.edit');
Route::get('trip/{id}/delete', [TripController::class, 'destroy'])->name('trip.destroy');

Route::get('trips/scheduled', [TripController::class, 'tripScheduled'])->name('trip.scheduled');

Route::get('trips/completed', [TripController::class, 'tripCompleted'])->name('trip.completed');
Route::get('trips/cancelled', [TripController::class, 'tripCancelled'])->name('trip.cancelled');
Route::get('trips/billed', [TripController::class, 'tripBilled'])->name('trip.billed');



/**
 * vehicle Routes
 * 
 */

Route::get('vehicle', [VehicleController::class, 'index'])->name('vehicle');

Route::get('vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
Route::get('vehicle/insurance', [VehicleController::class, 'vehicleInsurance'])->name('vehicle.insurance.index');

Route::get('vehicle/{id}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
Route::get('vehicle/{id}/delete', [VehicleController::class, 'destroy'])->name('vehicle.destroy');
/****
 * 
 * Vehicle Insurance
 * 
 */
// vehicle/insurance/create
Route::get('create', [VehicleInsuranceController::class, 'create'])->name('vehicle.insurance.create');

/***
 * Vehicle Maintaince OR servincing
 */

 Route::get('vehicle/maintenance', [VehicleServiceController::class, 'index'])->name('vehicle.maintenance');

//  create
 Route::get('vehicle/maintenance/create', [VehicleServiceController::class, 'create'])->name('vehicle.maintenance.create');

 /****
  * 
  *Manage Driver License 
  *driver.license.index
  */
   Route::get('/driver/license', [DriversLicensesController::class, 'index'])->name('driver.license.index');
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PSVBadgeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TripPaymentController;
use App\Http\Controllers\VehiclePartController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\RepairCategoryController;
use App\Http\Controllers\RouteLocationsController;
use App\Http\Controllers\VehicleServiceController;
use App\Http\Controllers\DriversLicensesController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\InsuranceCompanyController;
use App\Http\Controllers\VehicleInsuranceController;
use App\Http\Controllers\VehicleRefuelingController;
use App\Http\Controllers\AccountingSettingController;
use App\Http\Controllers\MaintenanceRepairController;
use App\Http\Controllers\RefuellingStationController;
use App\Http\Controllers\MaintenanceServiceController;
use App\Http\Controllers\VehiclePartCategoryController;

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth', 'can:view dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit')
        ->middleware('auth', 'can:edit profile');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update')
        ->middleware('auth', 'can:update profile');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy')
        ->middleware('auth', 'can:delete profile');
});

require __DIR__ . '/auth.php';

/***
 * User Interfaces
 * 
 */
Route::get('/admin/user', [UserController::class, 'index'])
    ->name('user.index')
    ->middleware('auth', 'can:view user');

Route::get('/admin/user/create-user-interface', [UserController::class, 'create'])
    ->name('user.create')
    ->middleware('auth', 'can:create user');

Route::post('/admin/user/update', [UserController::class, 'store'])
    ->name('user.store')
    ->middleware('auth', 'can:create user');

Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])
    ->name('user.edit')
    ->middleware('auth', 'can:edit user');

Route::post('/admin/user/{id}/update', [UserController::class, 'update'])
    ->name('user.update')
    ->middleware('auth', 'can:edit user');

Route::get('/admin/user/{id}/delete', [UserController::class, 'delete'])
    ->name('user.delete')
    ->middleware('auth', 'can:delete user');

Route::post('/admin/user/{id}/destroy', [UserController::class, 'destory'])
    ->name('user.destroy')
    ->middleware('auth', 'can:delete user');


/**
 * Employees Routes
 * 
 */

// View Employees
Route::get('employee', [EmployeeController::class, 'index'])
    ->name('employee')
    ->middleware('auth', 'can:view customers');

// Create Employee
Route::get('employee/create', [EmployeeController::class, 'create'])
    ->name('employee.create')
    ->middleware('auth', 'can:create customer');

Route::post('employee', [EmployeeController::class, 'store'])
    ->name('employee.create.store')
    ->middleware('auth', 'can:create customer');

// Update Employee Details
Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])
    ->name('employee.edit')
    ->middleware('auth', 'can:edit customer');

Route::put('employee/{id}/update', [EmployeeController::class, 'update'])
    ->name('employee.update')
    ->middleware('auth', 'can:edit customer');

Route::get('employee/{id}/activate', [EmployeeController::class, 'activateForm'])
    ->name('employee.activate.form')
    ->middleware('auth', 'can:edit customer');

Route::put('employee/{id}/activate', [EmployeeController::class, 'activate'])
    ->name('employee.activate')
    ->middleware('auth', 'can:edit customer');

Route::get('employee/{id}/deactivate', [EmployeeController::class, 'deactivateForm'])
    ->name('employee.deactivate.form')
    ->middleware('auth', 'can:edit customer');

Route::put('employee/{id}/deactivate', [EmployeeController::class, 'deactivate'])
    ->name('employee.deactivate')
    ->middleware('auth', 'can:edit customer');

Route::get('employee/{id}/delete', [EmployeeController::class, 'delete'])
    ->name('employee.delete')
    ->middleware('auth', 'can:delete customer');

Route::delete('employee/{id}/delete', [EmployeeController::class, 'destroy'])
    ->name('employee.destroy')
    ->middleware('auth', 'can:delete customer');


/***
 * Import Employee
 * 
 */

Route::get('employee/import', [EmployeeController::class, 'importFile'])
    ->name('employee.import.file')
    ->middleware('auth', 'can:import customer');

Route::post('employee/import/store', [EmployeeController::class, 'import'])
    ->name('employee.import.store')
    ->middleware('auth', 'can:import customer');

/****
 * export Employee
 * 
 */
Route::get('employee/export', [EmployeeController::class, 'export'])
    ->name('employee.export')
    ->middleware('auth', 'can:export customer');




/***
 * Organisations Routes
 */

// Organisation Dashboard

Route::get('organisation/dashboard', [OrganisationController::class, 'dashboard'])
    ->name('organisation.dashboard')
    ->middleware('auth', 'can:view dashboard');


// View Organisations
Route::get('organisation', [OrganisationController::class, 'index'])
    ->name('organisation')
    ->middleware('auth', 'can:view organisations');

// Create Organisation
Route::get('organisation/create', [OrganisationController::class, 'create'])
    ->name('organisation.create.form')
    ->middleware('auth', 'can:create organisation');

Route::post('organisation', [OrganisationController::class, 'store'])
    ->name('organisation.create')
    ->middleware('auth', 'can:create organisation');

// Update Organisation Details
Route::get('organisation/{id}/edit', [OrganisationController::class, 'edit'])
    ->name('organisation.edit')
    ->middleware('auth', 'can:edit organisation');

Route::get('organisation/{id}/activate', [OrganisationController::class, 'activateForm'])
    ->name('organisation.activate.form')
    ->middleware('auth', 'can:edit organisation');

Route::put('organisation/{id}/activate', [OrganisationController::class, 'activate'])
    ->name('organisation.activate')
    ->middleware('auth', 'can:edit organisation');

Route::get('organisation/{id}/deactivate', [OrganisationController::class, 'deactivateForm'])
    ->name('organisation.deactivate.form')
    ->middleware('auth', 'can:edit organisation');

Route::put('organisation/{id}/deactivate', [OrganisationController::class, 'deactivate'])
    ->name('organisation.deactivate')
    ->middleware('auth', 'can:edit organisation');

Route::put('organisation/{id}/update', [OrganisationController::class, 'update'])
    ->name('organisation.update')
    ->middleware('auth', 'can:edit organisation');

// Delete Organisation
Route::get('organisation/{id}/delete', [OrganisationController::class, 'destroy'])
    ->name('organisation.destroy')
    ->middleware('auth', 'can:delete organisation');

/**
 * Drivers Routes
 * 
 */


Route::get('driver', [DriverController::class, 'index'])
    ->name('driver')
    ->middleware('auth', 'can:view drivers');

Route::get('driver/create', [DriverController::class, 'create'])
    ->name('driver.create')
    ->middleware('auth', 'can:create driver');
Route::post('driver', [DriverController::class, 'store'])
    ->name('driver.store')
    ->middleware('auth', 'can:create driver');
Route::put('driver/{id}/update', [DriverController::class, 'update'])
    ->name('driver.update')
    ->middleware('auth', 'can:edit driver');
Route::get('driver/{id}/edit', [DriverController::class, 'edit'])
    ->name('driver.edit')
    ->middleware('auth', 'can:edit driver');
Route::post('driver/{id}/delete', [DriverController::class, 'destroy'])
    ->name('driver.destroy')
    ->middleware('auth', 'can:delete driver');
Route::get('driver/{id}/activate', [DriverController::class, 'activateForm'])
    ->name('driver.activate')
    ->middleware('auth', 'can:activate driver');
Route::put('driver/{id}/activateStore', [DriverController::class, 'activate'])
    ->name('driver.activateStore')
    ->middleware('auth', 'can:activate driver');
Route::get('driver/{id}/deactivate', [DriverController::class, 'deactivateForm'])
    ->name('driver.deactivate.form')
    ->middleware('auth', 'can:deactivate driver');
Route::put('driver/{id}/deactivate', [DriverController::class, 'deactivate'])
    ->name('driver.deactivate')
    ->middleware('auth', 'can:deactivate driver');

Route::get('driver/performance', [DriverController::class, 'driverPerformance'])
    ->name('driver.performance.index')
    ->middleware('auth', 'can:view driver performance');

Route::get('performance/create', [DriverController::class, 'createDriverPerformance'])
    ->name('driver.performance.create')
    ->middleware('auth', 'can:create driver performance');

/**
 * Drivers Licenses Routes
 */

// View Licenses
Route::get('driver/license', [DriversLicensesController::class, 'index'])
    ->name('driver.license.index')
    ->middleware('auth', 'can:view driver licenses');

// Create License
Route::get('driver/license/create', [DriversLicensesController::class, 'create'])
    ->name('driver.license.create')
    ->middleware('auth', 'can:create driver license');
Route::post('driver/license', [DriversLicensesController::class, 'store'])
    ->name('driver.license')
    ->middleware('auth', 'can:create driver license');

// Update License Details
Route::get('driver/license/{id}/edit', [DriversLicensesController::class, 'edit'])
    ->name('driver.license.edit')
    ->middleware('auth', 'can:edit driver license');
Route::put('driver/license/{id}/update', [DriversLicensesController::class, 'update'])
    ->name('driver.license.update')
    ->middleware('auth', 'can:edit driver license');

// Verify License
Route::get('driver/license/{id}/verify', [DriversLicensesController::class, 'verify'])
    ->name('driver.license.verify.form')
    ->middleware('auth', 'can:verify driver license');
Route::put('driver/license/{id}/verify', [DriversLicensesController::class, 'verifyStore'])
    ->name('driver.license.verify')
    ->middleware('auth', 'can:verify driver license');

// Revoke License
Route::get('driver/license/{id}/revoke', [DriversLicensesController::class, 'revoke'])
    ->name('driver.license.revoke.store')
    ->middleware('auth', 'can:revoke driver license');
Route::put('driver/license/{id}/revoke', [DriversLicensesController::class, 'revokeStore'])
    ->name('driver.license.revoke')
    ->middleware('auth', 'can:revoke driver license');

// Delete License
Route::get('driver/license/{id}/delete', [DriversLicensesController::class, 'delete'])
    ->name('driver.license.delete')
    ->middleware('auth', 'can:delete driver license');
Route::delete('driver/license/{id}/delete', [DriversLicensesController::class, 'destroy'])
    ->name('driver.license.destroy')
    ->middleware('auth', 'can:delete driver license');

/**
 * Drivers PSV Badge Routes
 */

// View PSV Badges
Route::get('driver/psvbadge', [PSVBadgeController::class, 'index'])
    ->name('driver.psvbadge.index')
    ->middleware('auth', 'can:view psv badges');

// Create PSV Badge
Route::get('driver/psvbadge/create', [PSVBadgeController::class, 'create'])
    ->name('driver.psvbadge.create')
    ->middleware('auth', 'can:create psv badge');
Route::post('driver/psvbadge', [PSVBadgeController::class, 'store'])
    ->name('driver.psvbadge')
    ->middleware('auth', 'can:create psv badge');

// Update PSV Badge Details
Route::get('driver/psvbadge/{id}/edit', [PSVBadgeController::class, 'edit'])
    ->name('driver.psvbadge.edit')
    ->middleware('auth', 'can:edit psv badge');
Route::put('driver/psvbadge/{id}/update', [PSVBadgeController::class, 'update'])
    ->name('driver.psvbadge.update')
    ->middleware('auth', 'can:edit psv badge');

// Verify PSV Badge
Route::get('driver/psvbadge/{id}/verify', [PSVBadgeController::class, 'verify'])
    ->name('driver.psvbadge.verify.form')
    ->middleware('auth', 'can:verify psv badge');
Route::put('driver/psvbadge/{id}/verify', [PSVBadgeController::class, 'verifyStore'])
    ->name('driver.psvbadge.verify')
    ->middleware('auth', 'can:verify psv badge');

// Revoke PSV Badge
Route::get('driver/psvbadge/{id}/revoke', [PSVBadgeController::class, 'revoke'])
    ->name('driver.psvbadge.revoke.form')
    ->middleware('auth', 'can:revoke psv badge');
Route::put('driver/psvbadge/{id}/revoke', [PSVBadgeController::class, 'revokeStore'])
    ->name('driver.psvbadge.revoke')
    ->middleware('auth', 'can:revoke psv badge');

// Delete PSV Badge
Route::get('driver/psvbadge/{id}/delete', [PSVBadgeController::class, 'delete'])
    ->name('driver.psvbadge.delete')
    ->middleware('auth', 'can:delete psv badge');
Route::delete('driver/psvbadge/{id}/delete', [PSVBadgeController::class, 'destroy'])
    ->name('driver.psvbadge.destroy')
    ->middleware('auth', 'can:delete psv badge');

/**
 * 'Routes' Routes
 * 
 */

// View Routes
Route::get('route', [RouteController::class, 'index'])
    ->name('route.index')
    ->middleware('auth', 'can:view route');

// Create Route
Route::get('route/create', [RouteController::class, 'create'])
    ->name('route.create')
    ->middleware('auth', 'can:create route');
Route::post('route', [RouteController::class, 'store'])
    ->name('route.store')
    ->middleware('auth', 'can:create route');

// Update Route Details
Route::get('route/{id}/edit', [RouteController::class, 'edit'])
    ->name('route.edit')
    ->middleware('auth', 'can:edit route');
Route::put('route/{id}/update', [RouteController::class, 'update'])
    ->name('route.update')
    ->middleware('auth', 'can:edit route');

// Delete Route
Route::get('route/{id}/delete', [RouteController::class, 'delete'])
    ->name('route.delete')
    ->middleware('auth', 'can:delete route');
Route::delete('route/{id}/delete', [RouteController::class, 'destroy'])
    ->name('route.destroy')
    ->middleware('auth', 'can:delete route');

/**
 * Route Location Routes
 * 
 */

// View Route Locations
Route::get('route/location', [RouteLocationsController::class, 'index'])
    ->name('route.location.index')
    ->middleware('auth', 'can:view route location');

// Create Route Location
Route::get('route/location/create', [RouteLocationsController::class, 'create'])
    ->name('route.location.create')
    ->middleware('auth', 'can:create route location');
Route::post('route/location/store', [RouteLocationsController::class, 'store'])
    ->name('route.location.store')
    ->middleware('auth', 'can:create route location');
Route::post('route/locations/get/all', [RouteLocationsController::class, 'getAllRouteWayPoints'])
    ->name('route.location.waypoints')
    ->middleware('auth', 'can:view route location');

/**
 * Tripes Routes
 * 
 */

Route::get('trips', [TripController::class, 'index'])
    ->name('booked.trip')
    ->middleware('auth', 'can:view trip');

Route::get('/trip/create', [TripController::class, 'create'])
    ->name('trip.create')
    ->middleware('auth', 'can:create trip');
Route::post('/trip/store', [TripController::class, 'store'])
    ->name('trip.store')
    ->middleware('auth', 'can:create trip');

Route::get('trip/{id}/edit', [TripController::class, 'edit'])
    ->name('trip.edit')
    ->middleware('auth', 'can:edit trip');
Route::get('trip/{id}/update', [TripController::class, 'update'])
    ->name('trip.update')
    ->middleware('auth', 'can:edit trip');

Route::get('trip/{id}/delete', [TripController::class, 'destroy'])
    ->name('trip.delete')
    ->middleware('auth', 'can:delete trip');
Route::get('trip/{id}/destroy', [TripController::class, 'destroy'])
    ->name('trip.destroy')
    ->middleware('auth', 'can:delete trip');

Route::get('trips/scheduled', [TripController::class, 'tripScheduled'])
    ->name('trip.scheduled')
    ->middleware('auth', 'can:view trip');
Route::get('trips/completed', [TripController::class, 'tripCompleted'])
    ->name('trip.completed')
    ->middleware('auth', 'can:view trip');
Route::get('trips/cancelled', [TripController::class, 'tripCancelled'])
    ->name('trip.cancelled')
    ->middleware('auth', 'can:view trip');
Route::get('trips/billed', [TripController::class, 'tripBilled'])
    ->name('trip.billed')
    ->middleware('auth', 'can:view trip');

// Complete Trip
Route::get('trip/{id}/complete', [TripController::class, 'completeTripForm'])
    ->name('trip.complete.form')
    ->middleware('auth', 'can:complete trip');

// Assign Vehicle to Trips
Route::get('trip/vehicle-assign', [TripController::class, 'assignVehicleToTrips'])
    ->name('trip.vehicle-assign')
    ->middleware('auth', 'can:complete trip');

// Complete Trip
Route::put('trip/{id}/complete', [TripController::class, 'completeTrip'])
    ->name('trip.complete')
    ->middleware('auth', 'can:complete trip');

// Cancel Trip
Route::get('trip/{id}/cancel', [TripController::class, 'cancelTripForm'])
    ->name('trip.cancel.form')
    ->middleware('auth', 'can:cancel trip');

// Cancel Trip
Route::put('trip/{id}/cancel', [TripController::class, 'cancelTrip'])
    ->name('trip.cancel')
    ->middleware('auth', 'can:cancel trip');

// Add Trip Billing Details

Route::get('trips/{id}/details', [TripController::class, 'details'])
    ->name('trips.details.edit')
    ->middleware('auth', 'can:edit trip');

Route::put('trips/{id}/details', [TripController::class, 'detailsPut'])
    ->name('trips.details')
    ->middleware('auth', 'can:edit trip');

// Bill Trip

Route::get('trip/{id}/bill', [TripController::class, 'bill'])
    ->name('trips.bill.form')
    ->middleware('auth', 'can:edit trip');

Route::put('trips/{id}/bill', [TripController::class, 'billPut'])
    ->name('trips.bill')
    ->middleware('auth', 'can:bill trip');

// Get Billing Rate

Route::get('get-billing-rate/{id}', [TripController::class, 'getBillingRate'])
    ->name('trip.get-billing-rate')
    ->middleware('auth', 'can:bill trip');

Route::get('trip/billed/{id}/payment/checkout', [TripController::class, 'tripPaymentCheckOut'])
    ->name('trip.payment.checkout')
    ->middleware('auth', 'can:bill trip');

/**
 * Trip Payment Routes
 * 
 */

Route::get('trip/billed/{id}/recieve/payment', [TripPaymentController::class, 'billedTripRecievePayment'])
    ->name('billed.trip.recieve.payment')
    ->middleware('auth', 'can:bill trip');

Route::post('trip/billed/{id}/recieve/payment/store', [TripPaymentController::class, 'billedTripRecievePaymentStore'])
    ->name('billed.trip.recieve.payment.store')
    ->middleware('auth', 'can:bill trip');


Route::get('billed/trip/{id}/download/invoice', [TripPaymentController::class, 'billedTripDownloadInvoice'])
    ->name('billed.trip.download.invoice')
    ->middleware('auth', 'can:bill trip');

Route::get('billed/trip/{id}/resend/invoice', [TripPaymentController::class, 'billedTripResendInvoice'])
    ->name('billed.trip.resend.invoice')
    ->middleware('auth', 'can:bill trip');

Route::get('billed/trip/{id}/send/invoice', [TripPaymentController::class, 'billedTripSendInvoice'])
    ->name('billed.trip.send.invoice')
    ->middleware('auth', 'can:bill trip');


/**
 * vehicle Routes
 * 
 */

Route::get('/vehicle', [VehicleController::class, 'index'])
    ->name('vehicle')
    ->middleware('auth', 'can:view vehicle');

Route::get('/vehicle/create', [VehicleController::class, 'create'])
    ->name('vehicle.create')
    ->middleware('auth', 'can:create vehicle');
Route::post('/vehicle/store', [VehicleController::class, 'store'])
    ->name('vehicle.store.new')
    ->middleware('auth', 'can:create vehicle');

Route::get('/vehicle/{id}/edit', [VehicleController::class, 'edit'])
    ->name('vehicle.edit')
    ->middleware('auth', 'can:edit vehicle');
Route::put('/vehicle/{id}', [VehicleController::class, 'update'])
    ->name('vehicle.update')
    ->middleware('auth', 'can:edit vehicle');

// vehicle/{{ $vehicle->id }}/assign/driver
Route::get('/vehicle/{id}/assign/driver', [VehicleController::class, 'assignDriverForm'])
    ->name('vehicle.assign.driver.form')
    ->middleware('auth', 'can:assign driver to vehicle');
Route::put('/vehicle/{id}/assign/driver', [VehicleController::class, 'assignDriver'])
    ->name('vehicle.assign.driver')
    ->middleware('auth', 'can:assign driver to vehicle');

Route::get('/vehicle/{id}/delete', [VehicleController::class, 'destroy'])
    ->name('vehicle.destroy')
    ->middleware('auth', 'can:delete vehicle');

// Activate Vehicle 
Route::get('vehicle/{id}/activate', [VehicleController::class, 'activateForm'])
    ->name('vehicle.activate')
    ->middleware('auth', 'can:activate vehicle');
Route::put('vehicle/{id}/activateStore', [VehicleController::class, 'activate'])
    ->name('vehicle.activateStore')
    ->middleware('auth', 'can:activate vehicle');
Route::get('vehicle/{id}/deactivate', [VehicleController::class, 'deactivateForm'])
    ->name('vehicle.deactivate')
    ->middleware('auth', 'can:deactivate vehicle');
Route::put('vehicle/{id}/deactivateStore', [VehicleController::class, 'deactivate'])
    ->name('vehicle.deactivateStore')
    ->middleware('auth', 'can:deactivate vehicle');

// Delete Vehicle
Route::get('vehicle/{id}/delete', [VehicleController::class, 'delete'])
    ->name('vehicle.delete')
    ->middleware('auth', 'can:delete vehicle');
Route::delete('vehicle/{id}/delete', [VehicleController::class, 'destroy'])
    ->name('vehicle.destroy')
    ->middleware('auth', 'can:delete vehicle');

/***
 * Vehicle Maintaince Repair Routes
 */

// View Vehicle Maintenance Repairs
Route::get('maintenance/repair', [MaintenanceRepairController::class, 'index'])
    ->name('maintenance.repair')
    ->middleware('auth', 'can:view vehicle maintenance');

// Create Vehicle Maintenance Repairs
Route::get('maintenance/repair/create', [MaintenanceRepairController::class, 'create'])
    ->name('maintenance.repair.create')
    ->middleware('auth', 'can:create vehicle maintenance');

Route::post('maintenance/repair/create', [MaintenanceRepairController::class, 'store'])
    ->name('maintenance.repair.store')
    ->middleware('auth', 'can:create vehicle maintenance');

// Edit Vehicle Maintenance Repairs
Route::get('maintenance/repair/{id}/edit', [MaintenanceRepairController::class, 'edit'])
    ->name('maintenance.repair.edit')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('maintenance/repair/{id}/edit', [MaintenanceRepairController::class, 'update'])
    ->name('maintenance.repair.update')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::get('maintenance/repair/{id}/approve', [MaintenanceRepairController::class, 'approveForm'])
    ->name('maintenance.repair.approve.form')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('maintenance/repair/{id}/approve', [MaintenanceRepairController::class, 'approve'])
    ->name('maintenance.repair.approve')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::get('maintenance/repair/{id}/reject', [MaintenanceRepairController::class, 'rejectForm'])
    ->name('maintenance.repair.reject.form')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('maintenance/repair/{id}/reject', [MaintenanceRepairController::class, 'reject'])
    ->name('maintenance.repair.reject')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::get('maintenance/repair/{id}/bill', [MaintenanceRepairController::class, 'billForm'])
    ->name('maintenance.repair.bill.form')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('maintenance/repair/{id}/bill', [MaintenanceRepairController::class, 'bill'])
    ->name('maintenance.repair.bill')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::get('maintenance/repair/{id}/redo', [MaintenanceRepairController::class, 'redoForm'])
    ->name('maintenance.repair.redo-repair.form')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('maintenance/repair/{id}/redo', [MaintenanceRepairController::class, 'redo'])
    ->name('maintenance.repair.redo-repair')
    ->middleware('auth', 'can:edit vehicle maintenance');

// Delete Vehicle Maintenance Repairs
Route::get('maintenance/repair/{id}/delete', [MaintenanceRepairController::class, 'delete'])
    ->name('maintenance.repair.delete')
    ->middleware('auth', 'can:delete vehicle maintenance');

Route::delete('maintenance/repair/{id}/delete', [MaintenanceRepairController::class, 'destroy'])
    ->name('maintenance.repair.destroy')
    ->middleware('auth', 'can:delete vehicle maintenance');

/***
 * Vehicle Maintaince Service Routes
 */

// View Vehicle Maintenance Services
Route::get('maintenance/service', [MaintenanceServiceController::class, 'index'])
    ->name('maintenance.service')
    ->middleware('auth', 'can:view vehicle maintenance');

// Create Vehicle Maintenance Services
Route::get('maintenance/service/create', [MaintenanceServiceController::class, 'create'])
    ->name('maintenance.service.create')
    ->middleware('auth', 'can:create vehicle maintenance');

Route::post('maintenance/service/create', [MaintenanceServiceController::class, 'store'])
    ->name('maintenance.service.store')
    ->middleware('auth', 'can:create vehicle maintenance');

// Approve Vehicle Maintenance Service
Route::get('maintenance/service/{id}/approve', [MaintenanceServiceController::class, 'approveForm'])
    ->name('maintenance.service.approve.form')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('maintenance/service/{id}/approve', [MaintenanceServiceController::class, 'approve'])
    ->name('maintenance.service.approve')
    ->middleware('auth', 'can:edit vehicle maintenance');

// Reject Vehicle Maintenance Service
Route::get('maintenance/service/{id}/reject', [MaintenanceServiceController::class, 'rejectForm'])
    ->name('maintenance.service.reject.form')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('maintenance/service/{id}/reject', [MaintenanceServiceController::class, 'reject'])
    ->name('maintenance.service.reject')
    ->middleware('auth', 'can:edit vehicle maintenance');

// Bill Vehicle Maintenance Service
Route::get('maintenance/service/{id}/bill', [MaintenanceServiceController::class, 'billForm'])
    ->name('maintenance.service.bill.form')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('maintenance/service/{id}/bill', [MaintenanceServiceController::class, 'bill'])
    ->name('maintenance.service.bill')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::get('maintenance/service/{id}/payment/checkout', [MaintenanceServiceController::class, 'maintenanceServicePaymentCheckOut'])
    ->name('vehicle.service.checkout')
    ->middleware('auth', 'can:bill vehicle maintenance');

/**
 * MaintenanceService Payment Routes
 * 
 */

Route::get('maintenance/service/{id}/receive/payment', [MaintenanceServiceController::class, 'billedVehicleServiceMaintenanceRecievePayment'])
    ->name('billed.vehicle.service.receive.payment')
    ->middleware('auth', 'can:bill vehicle service maintenance');

Route::post('maintenance/service/{id}/recieve/payment/store', [MaintenanceServiceController::class, 'billedVehicleServiceMaintenanceRecievePaymentStore'])
    ->name('billed.vehicle.service.receive.payment.store')
    ->middleware('auth', 'can:bill vehicle service maintenance');


Route::get('maintenance/service/{id}/download/invoice', [MaintenanceServiceController::class, 'billedVehicleServiceMaintenanceDownloadInvoice'])
    ->name('billed.vehicle.service.download.invoice')
    ->middleware('auth', 'can:bill vehicle service maintenance');

Route::get('maintenance/service/{id}/resend/invoice', [MaintenanceServiceController::class, 'billedVehicleServiceMaintenanceResendInvoice'])
    ->name('billed.trip.resend.invoice')
    ->middleware('auth', 'can:bill vehicle service maintenance');

Route::get('maintenance/service/{id}/send/invoice', [MaintenanceServiceController::class, 'billedVehicleServiceMaintenanceSendInvoice'])
    ->name('billed.vehicle.service.send.invoice')
    ->middleware('auth', 'can:bill vehicle service maintenance');


/***
 * Vehicle Servicing Routes
 */

// view vehicle servicing type

Route::get('vehicle/maintenance/service', [ServiceController::class, 'index'])
    ->name('vehicle.maintenance.service')
    ->middleware('auth', 'can:view vehicle maintenance');

Route::get('service-categories/{serviceTypeId}', [ServiceController::class, 'getServiceCategories']);


// create vehicle servicing type

Route::get('vehicle/maintenance/service/create', [ServiceController::class, 'create'])
    ->name('vehicle.maintenance.service.create')
    ->middleware('auth', 'can:create vehicle maintenance');

Route::post('vehicle/maintenance/service/create', [ServiceController::class, 'store'])
    ->name('vehicle.maintenance.service.store')
    ->middleware('auth', 'can:create vehicle maintenance');

// edit vehicle servicing type

Route::get('vehicle/maintenance/service/{id}/edit', [ServiceController::class, 'edit'])
    ->name('vehicle.maintenance.service.edit')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('vehicle/maintenance/service/{id}/edit', [ServiceController::class, 'update'])
    ->name('vehicle.maintenance.service.update')
    ->middleware('auth', 'can:edit vehicle maintenance');

// delete vehicle servicing type

Route::get('vehicle/maintenance/service/{id}/delete', [ServiceController::class, 'delete'])
    ->name('vehicle.maintenance.service.delete')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::delete('vehicle/maintenance/service/{id}/delete', [ServiceController::class, 'destroy'])
    ->name('vehicle.maintenance.service.destroy')
    ->middleware('auth', 'can:edit vehicle maintenance');

/***
 * Vehicle Servicing Category Routes
 */

// view vehicle servicing category

Route::get('vehicle/maintenance/service/categories', [ServiceCategoryController::class, 'index'])
    ->name('vehicle.maintenance.service.categories')
    ->middleware('auth', 'can:view vehicle maintenance');

// create vehicle servicing category

Route::get('vehicle/maintenance/service/categories/create', [ServiceCategoryController::class, 'create'])
    ->name('vehicle.maintenance.service.categories.create')
    ->middleware('auth', 'can:view vehicle maintenance');

Route::post('vehicle/maintenance/service/categories/create', [ServiceCategoryController::class, 'store'])
    ->name('vehicle.maintenance.service.categories.store')
    ->middleware('auth', 'can:view vehicle maintenance');

// edit vehicle servicing category

Route::get('vehicle/maintenance/service/categories/{id}/edit', [ServiceCategoryController::class, 'edit'])
    ->name('vehicle.maintenance.service.categories.edit')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('vehicle/maintenance/service/categories/{id}/edit', [ServiceCategoryController::class, 'update'])
    ->name('vehicle.maintenance.service.categories.update')
    ->middleware('auth', 'can:edit vehicle maintenance');

// delete vehicle servicing category

Route::get('vehicle/maintenance/service/categories/{id}/delete', [ServiceCategoryController::class, 'delete'])
    ->name('vehicle.maintenance.service.categories.delete')
    ->middleware('auth', 'can:delete vehicle maintenance');

Route::delete('vehicle/maintenance/service/categories/{id}/delete', [ServiceCategoryController::class, 'destroy'])
    ->name('vehicle.maintenance.service.categories.destroy')
    ->middleware('auth', 'can:delete vehicle maintenance');

/***
 * Vehicle Repairs Routes
 */

// view vehicle repairs

Route::get('vehicle/maintenance/repairs', [RepairController::class, 'index'])
    ->name('vehicle.maintenance.repairs')
    ->middleware('auth', 'can:view vehicle maintenance');

// create vehicle repairs

Route::get('vehicle/maintenance/repairs/create', [RepairController::class, 'create'])
    ->name('vehicle.maintenance.repairs.create')
    ->middleware('auth', 'can:create vehicle maintenance');

Route::post('vehicle/maintenance/repairs/create', [RepairController::class, 'store'])
    ->name('vehicle.maintenance.repairs.store')
    ->middleware('auth', 'can:create vehicle maintenance');

// edit vehicle repairs

Route::get('vehicle/maintenance/repairs/{id}/edit', [RepairController::class, 'edit'])
    ->name('vehicle.maintenance.repairs.edit')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('vehicle/maintenance/repairs/{id}/edit', [RepairController::class, 'update'])
    ->name('vehicle.maintenance.repairs.update')
    ->middleware('auth', 'can:edit vehicle maintenance');

// delete vehicle repairs

Route::get('vehicle/maintenance/repairs/{id}/delete', [RepairController::class, 'delete'])
    ->name('vehicle.maintenance.repairs.delete')
    ->middleware('auth', 'can:delete vehicle maintenance');

Route::delete('vehicle/maintenance/repairs/{id}/delete', [RepairController::class, 'destroy'])
    ->name('vehicle.maintenance.repairs.destroy')
    ->middleware('auth', 'can:delete vehicle maintenance');

/***
 * Vehicle Parts Routes
 */

// view vehicle parts

Route::get('vehicle/maintenance/parts', [VehiclePartController::class, 'index'])
    ->name('vehicle.maintenance.parts')
    ->middleware('auth', 'can:view vehicle maintenance');

// create vehicle parts

Route::get('vehicle/maintenance/parts/create', [VehiclePartController::class, 'create'])
    ->name('vehicle.maintenance.parts.create')
    ->middleware('auth', 'can:create vehicle maintenance');

Route::post('vehicle/maintenance/parts/create', [VehiclePartController::class, 'store'])
    ->name('vehicle.maintenance.parts.update')
    ->middleware('auth', 'can:create vehicle maintenance');

// edit vehicle parts

Route::get('vehicle/maintenance/parts/{id}/edit', [VehiclePartController::class, 'edit'])
    ->name('vehicle.maintenance.parts.edit')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('vehicle/maintenance/parts/{id}/edit', [VehiclePartController::class, 'update'])
    ->name('vehicle.maintenance.parts.update')
    ->middleware('auth', 'can:create vehicle maintenance');

// delete vehicle parts

Route::get('vehicle/maintenance/parts/{id}/delete', [VehiclePartController::class, 'delete'])
    ->name('vehicle.maintenance.parts.delete')
    ->middleware('auth', 'can:delete vehicle maintenance');

Route::delete('vehicle/maintenance/parts/{id}/delete', [VehiclePartController::class, 'destroy'])
    ->name('vehicle.maintenance.parts.destroy')
    ->middleware('auth', 'can:delete vehicle maintenance');

/***
 * Vehicle Part Categories Routes
 */

// view vehicle part categories

Route::get('vehicle/maintenance/parts/category', [VehiclePartCategoryController::class, 'index'])
    ->name('vehicle.maintenance.parts.category')
    ->middleware('auth', 'can:view vehicle maintenance');

// create vehicle part category

Route::get('vehicle/maintenance/parts/category/create', [VehiclePartCategoryController::class, 'create'])
    ->name('vehicle.maintenance.parts.category.create')
    ->middleware('auth', 'can:create vehicle maintenance');

Route::post('vehicle/maintenance/parts/category/create', [VehiclePartCategoryController::class, 'store'])
    ->name('vehicle.maintenance.parts.category.store')
    ->middleware('auth', 'can:create vehicle maintenance');

// edit vehicle part categories

Route::get('vehicle/maintenance/parts/category/{id}/edit', [VehiclePartCategoryController::class, 'edit'])
    ->name('vehicle.maintenance.parts.category.edit')
    ->middleware('auth', 'can:edit vehicle maintenance');

Route::put('vehicle/maintenance/parts/category/{id}/edit', [VehiclePartCategoryController::class, 'update'])
    ->name('vehicle.maintenance.parts.category.update')
    ->middleware('auth', 'can:edit vehicle maintenance');

// delete vehicle part categories

Route::get('vehicle/maintenance/parts/category/{id}/delete', [VehiclePartCategoryController::class, 'delete'])
    ->name('vehicle.maintenance.parts.category.delete')
    ->middleware('auth', 'can:delete vehicle maintenance');

Route::delete('vehicle/maintenance/parts/category/{id}/delete', [VehiclePartCategoryController::class, 'destroy'])
    ->name('vehicle.maintenance.parts.category.destroy')
    ->middleware('auth', 'can:delete vehicle maintenance');

/***
 * Vehicle Repair Categories Routes
 */

// view vehicle repairs

Route::get('vehicle/maintenance/repairs/categories', [RepairCategoryController::class, 'index'])
    ->name('vehicle.maintenance.repairs.categories')
    ->middleware('auth', 'can:view vehicle maintenance');

/****
 * 
 *Manage Driver License 
 */
Route::get('/driver/license', [DriversLicensesController::class, 'index'])
    ->name('driver.license.index')
    ->middleware('auth', 'can:view driver license');

/***
 * 
 * Manage Vehicle Refueling
 */

// View Vehicle Refueling
Route::get('refueling', [VehicleRefuelingController::class, 'index'])
    ->name('refueling.index')
    ->middleware('auth', 'can:view vehicle refueling');

// Create Vehicle Refueling
Route::get('/refueling/create', [VehicleRefuelingController::class, 'create'])
    ->name('refueling.create')
    ->middleware('auth', 'can:create vehicle refueling');

Route::post('/refueling/create', [VehicleRefuelingController::class, 'store'])
    ->name('refueling.store')
    ->middleware('auth', 'can:create vehicle refueling');

// Edit Vehicle Refueling
Route::get('/refueling/{id}/edit', [VehicleRefuelingController::class, 'edit'])
    ->name('refueling.edit')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::put('/refueling/{id}/edit', [VehicleRefuelingController::class, 'update'])
    ->name('refueling.update')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::get('/refueling/{id}/approve', [VehicleRefuelingController::class, 'approveForm'])
    ->name('refueling.approve.form')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::put('/refueling/{id}/approve', [VehicleRefuelingController::class, 'approve'])
    ->name('refueling.approve')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::get('/refueling/{id}/reject', [VehicleRefuelingController::class, 'rejectForm'])
    ->name('refueling.reject.form')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::put('/refueling/{id}/reject', [VehicleRefuelingController::class, 'reject'])
    ->name('refueling.reject')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::get('/refueling/{id}/bill', [VehicleRefuelingController::class, 'billForm'])
    ->name('refueling.bill.form')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::put('/refueling/{id}/bill', [VehicleRefuelingController::class, 'bill'])
    ->name('refueling.bill')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::get('/refueling/{id}/redo', [VehicleRefuelingController::class, 'redoForm'])
    ->name('refueling.redo-refuel.form')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::put('/refueling/{id}/redo', [VehicleRefuelingController::class, 'redo'])
    ->name('refueling.redo-refuel')
    ->middleware('auth', 'can:edit vehicle refueling');

// Delete Vehicle Refueling
Route::get('/refueling/{id}/delete', [VehicleRefuelingController::class, 'delete'])
    ->name('refueling.delete')
    ->middleware('auth', 'can:delete vehicle refueling');

Route::delete('/refueling/{id}/delete', [VehicleRefuelingController::class, 'destroy'])
    ->name('refueling.destroy')
    ->middleware('auth', 'can:delete vehicle refueling');

/***
 * 
 * Manage Vehicle Refueling Stations
 */

// View Refueling Stations
Route::get('refueling/station', [RefuellingStationController::class, 'index'])
    ->name('refueling.station')
    ->middleware('auth', 'can:create vehicle refueling');

// Create Refueling Station
Route::get('refueling/station/create', [RefuellingStationController::class, 'create'])
    ->name('refueling.station.create')
    ->middleware('auth', 'can:create vehicle refueling');

Route::post('refueling/station/create', [RefuellingStationController::class, 'store'])
    ->name('refueling.station.store')
    ->middleware('auth', 'can:create vehicle refueling');

// Edit Refueling Station
Route::get('refueling/station/{id}/edit', [RefuellingStationController::class, 'edit'])
    ->name('refueling.station.edit')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::put('refueling/station/{id}/edit', [RefuellingStationController::class, 'update'])
    ->name('refueling.station.update')
    ->middleware('auth', 'can:edit vehicle refueling');

// Activate Refueling Station
Route::get('refueling/station/{id}/activate', [RefuellingStationController::class, 'activateForm'])
    ->name('refueling.station.activate.form')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::put('refueling/station/{id}/activate', [RefuellingStationController::class, 'activate'])
    ->name('refueling.station.activate')
    ->middleware('auth', 'can:edit vehicle refueling');

// Deactivate Refueling Station
Route::get('refueling/station/{id}/deactivate', [RefuellingStationController::class, 'deactivateForm'])
    ->name('refueling.station.deactivate.form')
    ->middleware('auth', 'can:edit vehicle refueling');

Route::put('refueling/station/{id}/deactivate', [RefuellingStationController::class, 'deactivate'])
    ->name('refueling.station.deactivate')
    ->middleware('auth', 'can:edit vehicle refueling');

// Delete Refueling Station
Route::get('refueling/station/{id}/delete', [RefuellingStationController::class, 'delete'])
    ->name('refueling.station.delete')
    ->middleware('auth', 'can:delete vehicle refueling');

Route::delete('refueling/station/{id}/delete', [RefuellingStationController::class, 'destroy'])
    ->name('refueling.station.destroy')
    ->middleware('auth', 'can:delete vehicle refueling');


// /type/create

Route::get('/type/create', [VehicleRefuelingController::class, 'typeCreate'])
    ->name('vehicle.refuel.type.create')
    ->middleware('auth', 'can:create vehicle refueling');

/***
 * 
 * Manage Inventory
 * 
 * 
 */
Route::get('/inventory/expense', [InventoryController::class, 'InventoryExpense'])
    ->name('inventory.expense.index')
    ->middleware('auth', 'can:view inventory expense');
Route::get('inventory/expense/type', [InventoryController::class, 'InventoryExpenseType'])
    ->name('inventory.expense.type')
    ->middleware('auth', 'can:view inventory expense');
Route::get('/inventory/category', [InventoryController::class, 'InventoryCategory'])
    ->name('inventory.category')
    ->middleware('auth', 'can:view inventory category');
Route::get('/inventory/location', [InventoryController::class, 'InventoryLocation'])
    ->name('inventory.location')
    ->middleware('auth', 'can:view inventory location');
Route::get('/inventory/stock', [InventoryController::class, 'InventoryTripType'])
    ->name('inventory.stock.management')
    ->middleware('auth', 'can:view inventory stock');
Route::get('/inventory/parts', [InventoryController::class, 'InventoryParts'])
    ->name('inventory.parts')
    ->middleware('auth', 'can:view inventory parts');
Route::get('/inventory/parts/usage', [InventoryController::class, 'InventoryPartsUsage'])
    ->name('inventory.parts.usage')
    ->middleware('auth', 'can:view inventory parts usage');
Route::get('/iventory/vendor', [InventoryController::class, 'InventoryTrVendor'])
    ->name('inventory.vendors')
    ->middleware('auth', 'can:view inventory vendors');
Route::get('/inventory/trip-type', [InventoryController::class, 'InventoryTripType'])
    ->name('inventory.trip.type')
    ->middleware('auth', 'can:view inventory trip type');

/***
 * Purchase Routes 
 * 
 */
Route::get('/purchase', [PurchaseController::class, 'index'])
    ->name('purchase.index')
    ->middleware('auth', 'can:view purchase');
Route::get('/purchase/create', [PurchaseController::class, 'create'])
    ->name('purchase.create')
    ->middleware('auth', 'can:create purchase');
/***
 * Reports routes
 */

// Employee Reports
Route::get('report/employee', [ReportController::class, 'employeeReport'])
    ->name('report.employee')
    ->middleware('auth', 'can:view report employee');

// Driver Reports
Route::get('report/driver', [ReportController::class, 'driverReport'])
    ->name('report.driver')
    ->middleware('auth', 'can:view report driver');

// Vehicle Reports
Route::get('report/vehicle', [ReportController::class, 'vehicleReport'])
    ->name('report.vehicle')
    ->middleware('auth', 'can:view report vehicle');

// Trips Reports
Route::get('report/trips', [ReportController::class, 'tripsReport'])
    ->name('report.trips')
    ->middleware('auth', 'can:view report vehicle requisition');

// Service Reports
Route::get('report/service', [ReportController::class, 'serviceReport'])
    ->name('report.service')
    ->middleware('auth', 'can:view report vehicle requisition');

// Repairs Reports
Route::get('report/repairs', [ReportController::class, 'repairsReport'])
    ->name('report.repairs')
    ->middleware('auth', 'can:view report vehicle requisition');

// Refueling Reports
Route::get('report/refueling', [ReportController::class, 'fuelReport'])
    ->name('report.refueling')
    ->middleware('auth', 'can:view report vehicle requisition');

Route::get('report/admin/pickdrop/requisition', [ReportController::class, 'pickDropRequisitionReport'])
    ->name('report.pickdrop.requisition')
    ->middleware('auth', 'can:view report pick drop requisition');
Route::get('report/admin/refuel/requisition', [ReportController::class, 'refuelRequisitionReport'])
    ->name('report.refuel.requisition')
    ->middleware('auth', 'can:view report refuel requisition');
Route::get('report/purchase', [ReportController::class, 'purchaseReport'])->name('report.purchase')
    ->middleware('auth', 'can:view report purchase');
Route::get('report/expense', [ReportController::class, 'expenseReport'])
    ->name('report.expense')
    ->middleware('auth', 'can:view report expense');
Route::get('report/maintenance', [ReportController::class, 'maintenanceReport'])
    ->name('report.maintenance')
    ->middleware('auth', 'can:view report maintenance');
/***
 * 
 * Settings Routes
 * 
 */

//  Update Settings
Route::put('settings', [SettingsController::class, 'update'])
    ->name('settings')
    ->middleware('auth', 'can:edit settings');

//  Site Settings
Route::get('/settings/site', [SettingsController::class, 'site'])
    ->name('settings.site')
    ->middleware('auth', 'can:view settings');

/**
 * 
 * Permissions and Role Routes 
 * 
 */

// View Permissions

Route::get('/admin/permission', [PermissionController::class, 'index'])
    ->name('permission.index')
    ->middleware(['auth', 'can:view permission']);

// Create Permissions

Route::get('/admin/permission/create', [PermissionController::class, 'create'])
    ->name('permission.create')
    ->middleware(['auth', 'can:create permission']);

Route::post('/admin/permission/create', [PermissionController::class, 'store'])
    ->name('permission.store')
    ->middleware(['auth', 'can:create permission']);

// Edit Permissions

Route::get('/admin/permission/{id}/edit', [PermissionController::class, 'edit'])
    ->name('permission.edit')
    ->middleware(['auth', 'can:edit permission']);

Route::put('/admin/permission/{id}/edit', [PermissionController::class, 'update'])
    ->name('permission.update')
    ->middleware(['auth', 'can:edit permission']);

// Delete Permissions

Route::get('/admin/permission/{id}/delete', [PermissionController::class, 'delete'])
    ->name('permission.delete')
    ->middleware(['auth', 'can:delete permission']);

Route::delete('/permission/{id}/delete', [PermissionController::class, 'destroy'])
    ->name('permission.destroy')
    ->middleware(['auth', 'can:delete permission']);

// View Roles

Route::get('/admin/role', [RoleController::class, 'index'])
    ->name('permission.role')
    ->middleware(['auth', 'can:view permission']);

Route::get('/admin/role/create', [RoleController::class, 'create'])->name('permission.role.create');
/**
 * 
 * Insurance companies
 * 
 */
Route::get('/vehicle/insurance/company', [InsuranceCompanyController::class, 'index'])
    ->name('vehicle.insurance.company')
    ->middleware('auth', 'can:view vehicle insurance company');
Route::get('/vehicle/insurance/company/create', [InsuranceCompanyController::class, 'create'])
    ->name('vehicle.insurance.company.create')
    ->middleware('auth', 'can:create vehicle insurance company');

Route::post('/vehicle/insurance/company/store', [InsuranceCompanyController::class, 'store'])
    ->name('vehicle.insurance.company.store')
    ->middleware('auth', 'can:create vehicle insurance company');

Route::get('/vehicle/insurance/company/{id}', [InsuranceCompanyController::class, 'show'])
    ->name('vehicle.insurance.company.show')
    ->middleware('auth', 'can:view vehicle insurance company');

Route::get('/vehicle/insurance/company/{id}/edit', [InsuranceCompanyController::class, 'edit'])
    ->name('vehicle.insurance.company.edit')
    ->middleware('auth', 'can:edit vehicle insurance company');

Route::put('/vehicle/insurance/company/{id}', [InsuranceCompanyController::class, 'update'])
    ->name('vehicle.insurance.company.update')
    ->middleware('auth', 'can:edit vehicle insurance company');

Route::delete('/vehicle/insurance/company/{id}', [InsuranceCompanyController::class, 'destroy'])
    ->name('vehicle.insurance.company.destroy')
    ->middleware('auth', 'can:delete vehicle insurance company');


// vehicle.insurance.recurring.period
Route::get('/vehicle/insurance/recurring-period', [InsuranceCompanyController::class, 'insuranceRecurringPeriod'])
    ->name('vehicle.insurance.recurring.period')
    ->middleware('auth', 'can:view vehicle insurance company');
Route::get('/vehicle/insurance/recurring-period/create', [InsuranceCompanyController::class, 'insuranceRecurringPeriodCreate'])
    ->name('vehicle.insurance.recurring.period.create')
    ->middleware('auth', 'can:create vehicle insurance company');

Route::post('/vehicle/insurance/recurring-period/store', [InsuranceCompanyController::class, 'insuranceRecurringPeriodStore'])
    ->name('vehicle.insurance.recurring.period.create.store')
    ->middleware('auth', 'can:create vehicle insurance company');
//vehicle.insurance.recurring.period.edit
Route::get('/vehicle/insurance/recurring-period/{id}/edit', [InsuranceCompanyController::class, 'insuranceRecurringPeriodEdit'])
    ->name('vehicle.insurance.recurring.period.edit')
    ->middleware('auth', 'can:edit vehicle insurance company');

Route::put('/vehicle/insurance/recurring-period/{id}', [InsuranceCompanyController::class, 'insuranceRecurringPeriodUpdate'])
    ->name('vehicle.insurance.recurring.period.update')
    ->middleware('auth', 'can:edit vehicle insurance company');


// Activate vehicle.insurance.company 
Route::get('/vehicle/insurance/company/{id}/activate', [InsuranceCompanyController::class, 'activateForm'])
    ->name('vehicle.insurance.company.activate')
    ->middleware('auth', 'can:activate vehicle insurance company');
Route::put('/vehicle/insurance/company/{id}/activateStore', [InsuranceCompanyController::class, 'activate'])
    ->name('vehicle.insurance.company.activateStore')
    ->middleware('auth', 'can:activate vehicle insurance company');
Route::get('/vehicle/insurance/company/{id}/deactivate', [InsuranceCompanyController::class, 'deactivateForm'])
    ->name('vehicle.insurance.company.deactivate')
    ->middleware('auth', 'can:deactivate vehicle insurance company');
Route::put('/vehicle/insurance/company/{id}/deactivateStore', [InsuranceCompanyController::class, 'deactivate'])
    ->name('vehicle.insurance.company.deactivateStore')
    ->middleware('auth', 'can:deactivate vehicle insurance company');

// Delete vehicle.insurance.company
Route::get('/vehicle/insurance/company/{id}/delete', [InsuranceCompanyController::class, 'delete'])
    ->name('vehicle.insurance.company.delete')
    ->middleware('auth', 'can:delete vehicle insurance company');
Route::delete('/vehicle/insurance/company/{id}/destory', [InsuranceCompanyController::class, 'destroy'])
    ->name('vehicle.insurance.company.destroy')
    ->middleware('auth', 'can:delete vehicle insurance company');

/****
 * VehicleInsurance Route
 */

Route::get('/vehicle/insurance/', [VehicleInsuranceController::class, 'index'])
    ->name('vehicle.insurance.index')
    ->middleware('auth', 'can:view vehicle insurance');
Route::get('/vehicle/insurance/create', [VehicleInsuranceController::class, 'create'])
    ->name('vehicle.insurance.create')
    ->middleware('can:create vehicle insurance');

Route::post('/vehicle/insurance/store', [VehicleInsuranceController::class, 'store'])
    ->name('vehicle.insurance.store')
    ->middleware('can:create vehicle insurance');

Route::get('/vehicle/insurance/{id}', [VehicleInsuranceController::class, 'show'])
    ->name('vehicle.insurance.show')
    ->middleware('can:show vehicle insurance');

Route::get('/vehicle/insurance/{id}/edit', [VehicleInsuranceController::class, 'edit'])
    ->name('vehicle.insurance.edit')
    ->middleware('can:edit vehicle insurance');

Route::put('/vehicle/insurance/{id}', [VehicleInsuranceController::class, 'update'])
    ->name('vehicle.insurance.update')
    ->middleware('can:edit vehicle insurance');

Route::get('/vehicle/insurance/{id}', [VehicleInsuranceController::class, 'delete'])
    ->name('vehicle.insurance.delete')
    ->middleware('can:delete vehicle insurance');

Route::delete('/vehicle/insurance/{id}', [VehicleInsuranceController::class, 'destroy'])
    ->name('vehicle.insurance.destroy')
    ->middleware('can:delete vehicle insurance');

/***
 * Route for metro Berry Accounting Settings
 * 
 */

Route::get('/metro-berry/accounting-setting', [AccountingSettingController::class, 'index'])
    ->name('metro.berry.account.setting')
    ->middleware('auth', 'can:view accounting setting');

Route::get('/accounting-setting/create', [AccountingSettingController::class, 'create'])
    ->name('metro.berry.account.setting.create')
    ->middleware('auth', 'can:create accounting setting');

Route::post('/accounting-setting/store', [AccountingSettingController::class, 'store'])
    ->name('metro.berry.account.setting.store')
    ->middleware('auth', 'can:create accounting setting');

Route::get('/accounting-setting/{id}/edit', [AccountingSettingController::class, 'edit'])
    ->name('metro.berry.account.setting.edit')
    ->middleware('auth', 'can:edit accounting setting');

Route::put('/accounting-setting/{id}/update', [AccountingSettingController::class, 'update'])
    ->name('metro.berry.account.setting.update')
    ->middleware('auth', 'can:edit accounting setting');

Route::get('/accounting-setting/{id}/delete', [AccountingSettingController::class, 'delete'])
    ->name('metro.berry.account.setting.delete')
    ->middleware('auth', 'can:delete accounting setting');

Route::delete('/accounting-setting/{id}/destroy', [AccountingSettingController::class, 'destroy'])
    ->name('metro.berry.account.setting.destroy')
    ->middleware('auth', 'can:delete accounting setting');

/**
 * 
 * For checking out the invoice blade template 
 * 
 * 
 * 
 */
Route::get('/admin/metro-Berry/Invoice', [TripController::class, 'metroBerryInvoiceTemplate'])
    ->name('metro.berry.invoice.template')
    ->middleware('can:edit trip');
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PSVBadgeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\VehicleServiceController;
use App\Http\Controllers\DriversLicensesController;
use App\Http\Controllers\InsuranceCompanyController;
use App\Http\Controllers\VehicleInsuranceController;
use App\Http\Controllers\VehicleRefuelingController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RouteLocationsController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;

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
    ->name('employee.create')
    ->middleware('auth', 'can:create customer');

// Update Employee Details
Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])
    ->name('employee.edit')
    ->middleware('auth', 'can:edit customer');

Route::put('employee/{id}/update', [EmployeeController::class, 'update'])
    ->name('employee.update')
    ->middleware('auth', 'can:edit customer');

Route::get('employee/{id}/activate', [EmployeeController::class, 'activateForm'])
    ->name('employee.activate')
    ->middleware('auth', 'can:edit customer');

Route::put('employee/{id}/activate', [EmployeeController::class, 'activate'])
    ->name('employee.activate')
    ->middleware('auth', 'can:edit customer');

Route::get('employee/{id}/deactivate', [EmployeeController::class, 'deactivateForm'])
->name('employee.deactivate')
->middleware('auth', 'can:edit customer');

Route::put('employee/{id}/deactivate', [EmployeeController::class, 'deactivate'])
    ->name('employee.deactivate')
    ->middleware('auth', 'can:edit customer');

Route::post('employee/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.delete');


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
    ->name('organisation.create')
    ->middleware('auth', 'can:create organisation');

Route::post('organisation', [OrganisationController::class, 'store'])
    ->name('organisation.create')
    ->middleware('auth', 'can:create organisation');

// Update Organisation Details
Route::get('organisation/{id}/edit', [OrganisationController::class, 'edit'])
    ->name('organisation.edit')
    ->middleware('auth', 'can:edit organisation');

Route::get('organisation/{id}/activate', [OrganisationController::class, 'activateForm'])
->name('organisation.activate')
->middleware('auth', 'can:edit organisation');

Route::put('organisation/{id}/activate', [OrganisationController::class, 'activate'])
->name('organisation.activate')
->middleware('auth', 'can:edit organisation');

Route::get('organisation/{id}/deactivate', [OrganisationController::class, 'deactivateForm'])
->name('organisation.deactivate')
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
    ->name('driver')
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
    ->name('driver.deactivate')
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
    ->name('driver.license.verify')
    ->middleware('auth', 'can:verify driver license');
Route::put('driver/license/{id}/verify', [DriversLicensesController::class, 'verifyStore'])
    ->name('driver.license.verify')
    ->middleware('auth', 'can:verify driver license');

// Revoke License
Route::get('driver/license/{id}/revoke', [DriversLicensesController::class, 'revoke'])
    ->name('driver.license.revoke')
    ->middleware('auth', 'can:revoke driver license');
Route::put('driver/license/{id}/revoke', [DriversLicensesController::class, 'revokeStore'])
    ->name('driver.license.revoke')
    ->middleware('auth', 'can:revoke driver license');

// Delete License
Route::get('driver/license/{id}/delete', [DriversLicensesController::class, 'delete'])
    ->name('driver.license.delete')
    ->middleware('auth', 'can:delete driver license');
Route::delete('driver/license/{id}/delete', [DriversLicensesController::class, 'destroy'])
    ->name('driver.license.delete')
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
    ->name('driver.psvbadge.verify')
    ->middleware('auth', 'can:verify psv badge');
Route::put('driver/psvbadge/{id}/verify', [PSVBadgeController::class, 'verifyStore'])
    ->name('driver.psvbadge.verify')
    ->middleware('auth', 'can:verify psv badge');

// Revoke PSV Badge
Route::get('driver/psvbadge/{id}/revoke', [PSVBadgeController::class, 'revoke'])
    ->name('driver.psvbadge.revoke')
    ->middleware('auth', 'can:revoke psv badge');
Route::put('driver/psvbadge/{id}/revoke', [PSVBadgeController::class, 'revokeStore'])
    ->name('driver.psvbadge.revoke')
    ->middleware('auth', 'can:revoke psv badge');

// Delete PSV Badge
Route::get('driver/psvbadge/{id}/delete', [PSVBadgeController::class, 'delete'])
    ->name('driver.psvbadge.delete')
    ->middleware('auth', 'can:delete psv badge');
Route::delete('driver/psvbadge/{id}/delete', [PSVBadgeController::class, 'destroy'])
    ->name('driver.psvbadge.delete')
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
    ->name('route.delete')
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
    ->name('trip.complete')
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
    ->name('trip.cancel')
    ->middleware('auth', 'can:cancel trip');

// Cancel Trip
Route::put('trip/{id}/cancel', [TripController::class, 'cancelTrip'])
    ->name('trip.cancel')
    ->middleware('auth', 'can:cancel trip');

// Add Trip Billing Details

Route::get('trips/{id}/details', [TripController::class, 'details'])
    ->name('trips.details')
    ->middleware('auth', 'can:edit trip');

Route::put('trips/{id}/details', [TripController::class, 'detailsPut'])
->name('trips.details')
->middleware('auth', 'can:edit trip');

// Bill Trip

Route::get('trip/{id}/bill', [TripController::class, 'bill'])
    ->name('trips.bill')
    ->middleware('auth', 'can:bill trip');

Route::put('trips/{id}/bill', [TripController::class, 'billPut'])
->name('trips.bill')
->middleware('auth', 'can:bill trip');

// Get Billing Rate

Route::get('get-billing-rate/{id}', [TripController::class, 'getBillingRate'])
->name('trip.get-billing-rate')
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
    ->name('driver.delete')
    ->middleware('auth', 'can:delete vehicle');
Route::delete('vehicle/{id}/delete', [VehicleController::class, 'destroy'])
    ->name('driver.delete')
    ->middleware('auth', 'can:delete vehicle');



/***
 * Vehicle Maintaince Routes
 */

Route::get('vehicle/maintenance', [VehicleServiceController::class, 'index'])
    ->name('vehicle.maintenance')
    ->middleware('auth', 'can:view vehicle maintenance');

//  create
Route::get('vehicle/maintenance/create', [VehicleServiceController::class, 'create'])
    ->name('vehicle.maintenance.create')
    ->middleware('auth', 'can:create vehicle maintenance');

/***
 * Vehicle Servicing Routes
 */

// view vehicle servicing type

Route::get('vehicle/maintenance/service', [ServiceController::class, 'index'])
    ->name('vehicle.maintenance.service')
    ->middleware('auth', 'can:view vehicle maintenance');

// create vehicle servicing type

Route::get('vehicle/maintenance/service/create', [ServiceController::class, 'create'])
    ->name('vehicle.maintenance.service.create')
    ->middleware('auth', 'can:create vehicle maintenance');

Route::post('vehicle/maintenance/service/create', [ServiceController::class, 'store'])
->name('vehicle.maintenance.service.create')
->middleware('auth', 'can:create vehicle maintenance');

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
    ->name('vehicle.maintenance.service.categories.create')
    ->middleware('auth', 'can:view vehicle maintenance');

/****
 * 
 *Manage Driver License 
 *driver.license.index
 */
Route::get('/driver/license', [DriversLicensesController::class, 'index'])
    ->name('driver.license.index')
    ->middleware('auth', 'can:view driver license');

/***
 * 
 * Manage Vehicle Refueling
 */
Route::get('refueling', [VehicleRefuelingController::class, 'index'])
    ->name('vehicle.refueling.index')
    ->middleware('auth', 'can:view vehicle refueling');

Route::get('/refueling/create', [VehicleRefuelingController::class, 'create'])
    ->name('vehicle.refueling.create')
    ->middleware('auth', 'can:create vehicle refueling');
Route::get('/refueling/requisition', [VehicleRefuelingController::class, 'requisition'])
    ->name('vehicle.refueling.requisition')
    ->middleware('auth', 'can:create vehicle refueling');
Route::get('/refueling/type', [VehicleRefuelingController::class, 'type'])
    ->name('vehicle.refuel.type')
    ->middleware('auth', 'can:create vehicle refueling');
Route::get('/refueling/station', [VehicleRefuelingController::class, 'station'])
    ->name('vehicle.refueling.station')
    ->middleware('auth', 'can:create vehicle refueling');
// /type/create

Route::get('/type/create', [VehicleRefuelingController::class, 'typeCreate'])
    ->name('vehicle.refuel.type.create')
    ->middleware('auth', 'can:create vehicle refueling');
// /station/create
Route::get('/station/create', [VehicleRefuelingController::class, 'stationCreate'])
    ->name('vehicle.refueling.station.create')
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
 * 
 * 
 */
// Reports
Route::get('report/employee', [ReportController::class, 'employeeReport'])
    ->name('report.employee')
    ->middleware('auth', 'can:view report employee');
Route::get('report/driver', [ReportController::class, 'driverReport'])
    ->name('report.driver')
    ->middleware('auth', 'can:view report driver');
Route::get('report/vehicle', [ReportController::class, 'vehicleReport'])
    ->name('report.vehicle')
    ->middleware('auth', 'can:view report vehicle');
Route::get('report/admin/vehicle/requisition', [ReportController::class, 'vehicleRequisitionReport'])
    ->name('report.vehicle.requisition')
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
Route::get('/admin/setting', [SettingsController::class, 'index'])
    ->name('settings.index')
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
    ->name('permission.delete')
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

Route::delete('/vehicle/insurance/{id}', [VehicleInsuranceController::class, 'destroy'])
    ->name('vehicle.insurance.destroy')
    ->middleware('can:delete vehicle insurance');
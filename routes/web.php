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
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\VehicleServiceController;
use App\Http\Controllers\DriversLicensesController;
use App\Http\Controllers\PSVBadgeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RouteLocationsController;
use App\Http\Controllers\VehicleInsuranceController;
use App\Http\Controllers\VehicleRefuelingController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/***
 * User Interfaces
 * 
 */

Route::get('/login', [UserController::class, 'index'])->name('user.login');
Route::get('/', [UserController::class, 'index'])->name('user.login');
Route::get('/admin/user', [UserController::class, 'index'])->name('user.interface.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('user.create');

/**
 * Employees Routes
 * 
 */

Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::get('employee', [EmployeeController::class, 'index'])->name('employee');
Route::post('employee', [EmployeeController::class, 'store'])->name('employee');

Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
Route::post('employee/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.delete');
/***
 * Organisations Routes
 */
// organisation organisation/create
Route::get('organisation/create', [OrganisationController::class, 'create'])->name('organisation.create');
Route::get('organisation', [OrganisationController::class, 'index'])->name('organisation');
Route::post('organisation', [OrganisationController::class, 'store'])->name('organisation');

Route::get('organisation/{id}/edit', [OrganisationController::class, 'edit'])->name('organisation.edit');
Route::get('organisation/{id}/delete', [OrganisationController::class, 'destroy'])->name('organisation.destroy');

/**
 * Drivers Routes
 * 
 */


Route::get('driver', [DriverController::class, 'index'])->name('driver');

Route::get('driver/create', [DriverController::class, 'create'])->name('driver.create');
Route::post('driver', [DriverController::class, 'store'])->name('driver');
Route::put('driver/{id}/update', [DriverController::class, 'update'])->name('driver.update');
Route::get('driver/{id}/edit', [DriverController::class, 'edit'])->name('driver.edit');
Route::post('driver/{id}/delete', [DriverController::class, 'destroy'])->name('driver.destroy');
Route::get('driver/{id}/activate', [DriverController::class, 'activateForm'])->name('driver.activate');
Route::put('driver/{id}/activateStore', [DriverController::class, 'activate'])->name('driver.activateStore');
Route::get('driver/{id}/deactivate', [DriverController::class, 'deactivateForm'])->name('driver.deactivate');
Route::put('driver/{id}/deactivate', [DriverController::class, 'deactivate'])->name('driver.deactivate');

Route::get('driver/performance', [DriverController::class, 'driverPerformance'])->name('driver.performance.index');
Route::get('performance/create', [DriverController::class, 'createDriverPerformance'])->name('driver.performance.create');

/**
 * Drivers Licenses Routes
 */

// View Licenses
Route::get('driver/license', [DriversLicensesController::class, 'index'])->name('driver.license.index');

// Create License
Route::get('driver/license/create', [DriversLicensesController::class, 'create'])->name('driver.license.create');
Route::post('driver/license', [DriversLicensesController::class, 'store'])->name('driver.license');

// Update License Details
Route::get('driver/license/{id}/edit', [DriversLicensesController::class, 'edit'])->name('driver.license.edit');
Route::put('driver/license/{id}/update', [DriversLicensesController::class, 'update'])->name('driver.license.update');

// Verify License
Route::get('driver/license/{id}/verify', [DriversLicensesController::class, 'verify'])->name('driver.license.verify');
Route::put('driver/license/{id}/verify', [DriversLicensesController::class, 'verifyStore'])->name('driver.license.verify');

// Revoke License
Route::get('driver/license/{id}/revoke', [DriversLicensesController::class, 'revoke'])->name('driver.license.revoke');
Route::put('driver/license/{id}/revoke', [DriversLicensesController::class, 'revokeStore'])->name('driver.license.revoke');

// Delete License
Route::get('driver/license/{id}/delete', [DriversLicensesController::class, 'delete'])->name('driver.license.delete');
Route::delete('driver/license/{id}/delete', [DriversLicensesController::class, 'destroy'])->name('driver.license.delete');

/**
 * Drivers PSV Badge Routes
 */

// View PSV Badges
Route::get('driver/psvbadge', [PSVBadgeController::class, 'index'])->name('driver.psvbadge.index');

// Create PSV Badge
Route::get('driver/psvbadge/create', [PSVBadgeController::class, 'create'])->name('driver.psvbadge.create');
Route::post('driver/psvbadge', [PSVBadgeController::class, 'store'])->name('driver.psvbadge');

// Update PSV Badge Details
Route::get('driver/psvbadge/{id}/edit', [PSVBadgeController::class, 'edit'])->name('driver.psvbadge.edit');
Route::put('driver/psvbadge/{id}/update', [PSVBadgeController::class, 'update'])->name('driver.psvbadge.update');

// Verify PSV Badge
Route::get('driver/psvbadge/{id}/verify', [PSVBadgeController::class, 'verify'])->name('driver.psvbadge.verify');
Route::put('driver/psvbadge/{id}/verify', [PSVBadgeController::class, 'verifyStore'])->name('driver.psvbadge.verify');

// Revoke PSV Badge
Route::get('driver/psvbadge/{id}/revoke', [PSVBadgeController::class, 'revoke'])->name('driver.psvbadge.revoke');
Route::put('driver/psvbadge/{id}/revoke', [PSVBadgeController::class, 'revokeStore'])->name('driver.psvbadge.revoke');

// Delete PSV Badge
Route::get('driver/psvbadge/{id}/delete', [PSVBadgeController::class, 'delete'])->name('driver.psvbadge.delete');
Route::delete('driver/psvbadge/{id}/delete', [PSVBadgeController::class, 'destroy'])->name('driver.psvbadge.delete');


/**
 * Organisation Routes
 * 
 */
Route::get('organisation', [OrganisationController::class, 'index'])->name('organisation');

Route::get('organisation/create', [OrganisationController::class, 'create'])->name('organisation.create');
Route::get('organisation/{id}/edit', [OrganisationController::class, 'edit'])->name('organisation.edit');
Route::put('organisation/{id}/update', [OrganisationController::class, 'update'])->name('organisation.update');
Route::post('organisation/{id}/delete', [OrganisationController::class, 'destroy'])->name('organisation.destroy');

/**
 * 'Routes' Routes
 * 
 */

Route::get('our-routes', [RouteController::class, 'index'])->name('our.routes');

Route::get('routes/create', [RouteController::class, 'create'])->name('route.create');
Route::get('edit-route/{id}/edit', [RouteController::class, 'edit'])->name('route.edit');
Route::get('route-delete/{id}/delete', [RouteController::class, 'destroy'])->name('route.destroy');
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
Route::get('vehicle/insurance/company', [VehicleInsuranceController::class, 'create'])->name('insurance.company');
Route::get('create', [VehicleInsuranceController::class, 'create'])->name('insurance.recurring.period');

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

/***
 * 
 * Manage Vehicle Refueling
 */
Route::get('refueling', [VehicleRefuelingController::class, 'index'])->name('vehicle.refueling.index');

Route::get('/refueling/create', [VehicleRefuelingController::class, 'create'])->name('vehicle.refueling.create');
Route::get('/refueling/requisition', [VehicleRefuelingController::class, 'requisition'])->name('vehicle.refueling.requisition');
Route::get('/refueling/type', [VehicleRefuelingController::class, 'type'])->name('vehicle.refuel.type');
Route::get('/refueling/station', [VehicleRefuelingController::class, 'station'])->name('vehicle.refueling.station');
// /type/create

Route::get('/type/create', [VehicleRefuelingController::class, 'typeCreate'])->name('vehicle.refuel.type.create');
// /station/create
Route::get('/station/create', [VehicleRefuelingController::class, 'stationCreate'])->name('vehicle.refueling.station.create');

/***
 * 
 * Manage Inventory
 * 
 * 
 */
Route::get('/inventory/expense', [InventoryController::class, 'InventoryExpense'])->name('inventory.expense.index');
Route::get('inventory/expense/type', [InventoryController::class, 'InventoryExpenseType'])->name('inventory.expense.type');
Route::get('/inventory/category', [InventoryController::class, 'InventoryCategory'])->name('inventory.category');
Route::get('/inventory/location', [InventoryController::class, 'InventoryLocation'])->name('inventory.location');
Route::get('/inventory/stock', [InventoryController::class, 'InventoryTripType'])->name('inventory.stock.management');
Route::get('/inventory/parts', [InventoryController::class, 'InventoryParts'])->name('inventory.parts');
Route::get('/inventory/parts/usage', [InventoryController::class, 'InventoryPartsUsage'])->name('inventory.parts.usage');
Route::get('/iventory/vendor', [InventoryController::class, 'InventoryTrVendor'])->name('inventory.vendors');
Route::get('/inventory/trip-type', [InventoryController::class, 'InventoryTripType'])->name('inventory.trip.type');

/***
 * Purchase Routes 
 * 
 */
Route::get('/purchase', [PurchaseController::class,'index'])->name('purchase.index');
Route::get('/purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');
/***
 * Reports routes 
 * 
 * 
 */
// Reports
Route::get('report/employee', [ReportController::class, 'employeeReport'])->name('report.employee');
Route::get('report/driver', [ReportController::class, 'driverReport'])->name('report.driver');
Route::get('report/vehicle', [ReportController::class, 'vehicleReport'])->name('report.vehicle');
Route::get('report/admin/vehicle/requisition', [ReportController::class, 'vehicleRequisitionReport'])->name('report.vehicle.requisition');
Route::get('report/admin/pickdrop/requisition', [ReportController::class, 'pickDropRequisitionReport'])->name('report.pickdrop.requisition');
Route::get('report/admin/refuel/requisition', [ReportController::class, 'refuelRequisitionReport'])->name('report.refuel.requisition');
Route::get('report/purchase', [ReportController::class, 'purchaseReport'])->name('report.purchase');
Route::get('report/expense', [ReportController::class, 'expenseReport'])->name('report.expense');
Route::get('report/maintenance', [ReportController::class, 'maintenanceReport'])->name('report.maintenance');
/***
 * 
 * Settings Routes
 * 
 */
Route::get('/admin/setting', [SettingsController::class, 'index'])->name('settings.index');

/**
 * 
 * Permissions and Role Routes 
 * 
 */
Route::get('/admin/permission', [PermissionController::class, 'index'])->name('permission.index');
Route::get('/admin/role', [RoleController::class, 'index'])->name('permission.role');
Route::get('/admin/role/create', [RoleController::class, 'create'])->name('permission.role.create');



/**
 * 
 * Routes routes
 * 
 */

Route::get('route', [RouteController::class, 'index'])->name('route.index');

// Create Route
Route::get('route/create', [RouteController::class, 'create'])->name('route.create');
Route::post('route', [RouteController::class, 'store'])->name('route');

Route::get('route/location', [RouteLocationsController::class, 'index'])->name('route.location.index');
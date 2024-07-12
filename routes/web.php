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

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth', 'can:view dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/***-
 * User Interfaces
 * 
 */

Route::get('/login', [UserController::class, 'index'])->name('login');
Route::get('/admin/user', [UserController::class, 'index'])->name('user.interface.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('user.create');


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

Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
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
 * 'Routes' Routes
 * 
 */

// View Routes
Route::get('route', [RouteController::class, 'index'])->name('route.index');

// Create Route
Route::get('route/create', [RouteController::class, 'create'])->name('route.create');
Route::post('route', [RouteController::class, 'store'])->name('route.store');

// Update Route Details
Route::get('route/{id}/edit', [RouteController::class, 'edit'])->name('route.edit');
Route::put('route/{id}/update', [RouteController::class, 'update'])->name('route.update');

// Delete Route
Route::get('route/{id}/delete', [RouteController::class, 'delete'])->name('route.delete');
Route::delete('route/{id}/delete', [RouteController::class, 'destroy'])->name('route.delete');

/**
 * Route Location Routes
 * 
 */

// View Route Locations
Route::get('route/location', [RouteLocationsController::class, 'index'])->name('route.location.index');

// Create Route Location
Route::get('route/location/create', [RouteLocationsController::class, 'create'])->name('route.location.create');

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

Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle');

Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store.new');

Route::get('/vehicle/{id}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
Route::put('/vehicle/{id}', [VehicleController::class, 'update'])->name('vehicle.update');

// vehicle/{{ $vehicle->id }}/assign/driver
Route::get('/vehicle/{id}/assign/driver', [VehicleController::class, 'assignDriverForm'])->name('vehicle.assign.driver.form');
Route::put('/vehicle/{id}/assign/driver', [VehicleController::class, 'assignDriver'])->name('vehicle.assign.driver');

Route::get('/vehicle/{id}/delete', [VehicleController::class, 'destroy'])->name('vehicle.destroy');

// Activate Vehicle 
Route::get('vehicle/{id}/activate', [VehicleController::class, 'activateForm'])->name('vehicle.activate');
Route::put('vehicle/{id}/activateStore', [VehicleController::class, 'activate'])->name('vehicle.activateStore');
Route::get('vehicle/{id}/deactivate', [VehicleController::class, 'deactivateForm'])->name('vehicle.deactivate');
Route::put('vehicle/{id}/deactivateStore', [VehicleController::class, 'deactivate'])->name('vehicle.deactivateStore');

// Delete Vehicle
Route::get('vehicle/{id}/delete', [VehicleController::class, 'delete'])->name('driver.delete');
Route::delete('vehicle/{id}/delete', [VehicleController::class, 'destroy'])->name('driver.delete');



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
Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.index');
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
 * Insurance companies
 * 
 */
Route::get('/vehicle/insurance/company', [InsuranceCompanyController::class, 'index'])->name('vehicle.insurance.company');
Route::get('/vehicle/insurance/company/create', [InsuranceCompanyController::class, 'create'])->name('vehicle.insurance.company.create');

Route::post('/vehicle/insurance/company/store', [InsuranceCompanyController::class, 'store'])->name('vehicle.insurance.company.store');

Route::get('/vehicle/insurance/company/{id}', [InsuranceCompanyController::class, 'show'])->name('vehicle.insurance.company.show');

Route::get('/vehicle/insurance/company/{id}/edit', [InsuranceCompanyController::class, 'edit'])->name('vehicle.insurance.company.edit');

Route::put('/vehicle/insurance/company/{id}', [InsuranceCompanyController::class, 'update'])->name('vehicle.insurance.company.update');

Route::delete('/vehicle/insurance/company/{id}', [InsuranceCompanyController::class, 'destroy'])->name('vehicle.insurance.company.destroy');


// vehicle.insurance.recurring.period
Route::get('/vehicle/insurance/recurring-period', [InsuranceCompanyController::class, 'insuranceRecurringPeriod'])->name('vehicle.insurance.recurring.period');
Route::get('/vehicle/insurance/recurring-period/create', [InsuranceCompanyController::class, 'insuranceRecurringPeriodCreate'])->name('vehicle.insurance.recurring.period.create');

Route::post('/vehicle/insurance/recurring-period/store', [InsuranceCompanyController::class, 'insuranceRecurringPeriodStore'])->name('vehicle.insurance.recurring.period.create.store');
//vehicle.insurance.recurring.period.edit
Route::get('/vehicle/insurance/recurring-period/{id}/edit', [InsuranceCompanyController::class, 'insuranceRecurringPeriodEdit'])->name('vehicle.insurance.recurring.period.edit');

Route::put('/vehicle/insurance/recurring-period/{id}', [InsuranceCompanyController::class, 'insuranceRecurringPeriodUpdate'])->name('vehicle.insurance.recurring.period.update');


// Activate vehicle.insurance.company 
Route::get('/vehicle/insurance/company/{id}/activate', [InsuranceCompanyController::class, 'activateForm'])->name('vehicle.insurance.company.activate');
Route::put('/vehicle/insurance/company/{id}/activateStore', [InsuranceCompanyController::class, 'activate'])->name('vehicle.insurance.company.activateStore');
Route::get('/vehicle/insurance/company/{id}/deactivate', [InsuranceCompanyController::class, 'deactivateForm'])->name('vehicle.insurance.company.deactivate');
Route::put('/vehicle/insurance/company/{id}/deactivateStore', [InsuranceCompanyController::class, 'deactivate'])->name('vehicle.insurance.company.deactivateStore');

// Delete vehicle.insurance.company
Route::get('/vehicle/insurance/company/{id}/delete', [InsuranceCompanyController::class, 'delete'])->name('vehicle.insurance.company.delete');
Route::delete('/vehicle/insurance/company/{id}/destory', [InsuranceCompanyController::class, 'destroy'])->name('vehicle.insurance.company.destroy');

/****
 * VehicleInsurance Route
 */

Route::get('/vehicle/insurance/', [VehicleInsuranceController::class, 'index'])->name('vehicle.insurance.index');
Route::get('/vehicle/insurance/create', [VehicleInsuranceController::class, 'create'])->name('vehicle.insurance.create');

Route::post('/vehicle/insurance/store', [VehicleInsuranceController::class, 'store'])->name('vehicle.insurance.store');

Route::get('/vehicle/insurance/{id}', [VehicleInsuranceController::class, 'show'])->name('vehicle.insurance.show');

Route::get('/vehicle/insurance/{id}/edit', [VehicleInsuranceController::class, 'edit'])->name('vehicle.insurance.edit');

Route::put('/vehicle/insurance/{id}', [VehicleInsuranceController::class, 'update'])->name('vehicle.insurance.update');

Route::delete('/vehicle/insurance/{id}', [VehicleInsuranceController::class, 'destroy'])->name('vehicle.insurance.destroy');
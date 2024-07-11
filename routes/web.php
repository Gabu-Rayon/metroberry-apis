<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\EmployeeController;
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

Route::get('driver/performance', [DriverController::class, 'driverPerformance'])->name('driver.performance.index');
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

Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle');

Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store.new');

Route::get('/vehicle/{id}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
Route::put('/vehicle/{id}', [VehicleController::class, 'update'])->name('vehicle.update');

// vehicle/{{ $vehicle->id }}/assign/driver
Route::get('/vehicle/{id}/assign/driver', [VehicleController::class, 'assignDriverForm'])->name('vehicle.assign.driver.form');
Route::put('/vehicle/{id}/assign/driver', [VehicleController::class, 'assignDriver'])->name('vehicle.assign.driver');

Route::get('/vehicle/{id}/delete', [VehicleController::class, 'destroy'])->name('vehicle.destroy');

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
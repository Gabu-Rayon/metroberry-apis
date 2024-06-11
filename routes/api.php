<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrganisationController;


Route::get('/user', function (Request $request) {
    $user = $request->user();
    $permissions = $user->getAllPermissions()->pluck('name')->toArray();
    Log::info('USER PERMISSIONS');
    Log::info($permissions);
    $user->permitted_to = $permissions;
    return $user;
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('routes', [AddRouteController::class, 'index'])->middleware(['auth:sanctum', 'can:view routes']);
Route::post('routes', [AddRouteController::class, 'store'])->middleware(['auth:sanctum', 'can:create route']);
Route::put('routes/{route}', [AddRouteController::class, 'update'])->middleware(['auth:sanctum', 'can:edit route']);
Route::delete('routes/{route}', [AddRouteController::class, 'destroy'])->middleware(['auth:sanctum', 'can:delete route']);
Route::get('routes/{route}', [AddRouteController::class, 'show'])->middleware(['auth:sanctum', 'can:show route']);

Route::get('vehicles', [VehicleController::class, 'index'])->middleware(['auth:sanctum', 'can:view vehicles']);
Route::get('vehicles/{vehicle}', [VehicleController::class, 'show'])->middleware(['auth:sanctum', 'can:show vehicle']);
Route::post('vehicles', [VehicleController::class, 'store'])->middleware(['auth:sanctum', 'can:create vehicles']);
Route::put('vehicles/{vehicle}', [VehicleController::class, 'update'])->middleware(['auth:sanctum', 'can:edit vehicle']);
Route::delete('vehicles/{vehicle}', [VehicleController::class, 'destroy'])->middleware(['auth:sanctum', 'can:delete vehicle']);
Route::post('assign-driver/{vehicle}', [VehicleController::class, 'assign_driver'])->middleware(['auth:sanctum', 'can:assign driver']);

Route::get('organisation', [OrganisationController::class, 'index'])->middleware(['auth:sanctum', 'can:view organisation']);
Route::post('organisation', [OrganisationController::class, 'store'])->middleware(['auth:sanctum', 'can:create organisation']);
Route::put('organisations/{organisation}', [OrganisationController::class, 'update'])->middleware(['auth:sanctum', 'can:edit organisation']);
Route::delete('organisations/{organisation}', [OrganisationController::class, 'destroy'])->middleware(['auth:sanctum', 'can:delete organisation']);
Route::get('organisations/{organisation}', [OrganisationController::class, 'show'])->middleware(['auth:sanctum', 'can:show organisation']);

Route::get('drivers', [DriverController::class, 'index'])->middleware(['auth:sanctum', 'can:view drivers']);
Route::post('drivers', [DriverController::class, 'store'])->middleware(['auth:sanctum', 'can:create driver']);
Route::put('drivers/{driver}', [DriverController::class, 'update'])->middleware(['auth:sanctum', 'can:edit driver']);
Route::delete('drivers/{driver}', [DriverController::class, 'destroy'])->middleware(['auth:sanctum', 'can:delete driver']);
Route::get('drivers/{driver}', [DriverController::class, 'show'])->middleware(['auth:sanctum', 'can:show driver']);

Route::get('customers', [CustomerController::class, 'index'])->middleware(['auth:sanctum', 'can:view customers']);
Route::post('customers', [CustomerController::class, 'store'])->middleware(['auth:sanctum', 'can:create customer']);
Route::post('customers/{id}', [CustomerController::class, 'show'])->middleware(['auth:sanctum', 'can:view customer']);
Route::put('customers/{id}', [CustomerController::class, 'update'])->middleware(['auth:sanctum', 'can:edit customer']);
Route::delete('customers/{id}', [CustomerController::class, 'destroy'])->middleware(['auth:sanctum', 'can:delete customer']);

Route::get('trip', [TripController::class, 'index'])->middleware(['auth:sanctum', 'can:view trips']);
Route::post('trip', [TripController::class, 'store'])->middleware(['auth:sanctum', 'can:create trip']);
Route::put('trips/{trip}', [TripController::class, 'update'])->middleware(['auth:sanctum', 'can:edit trip']);
Route::delete('trips/{trip}', [TripController::class, 'destroy'])->middleware(['auth:sanctum', 'can:delete trip']);
Route::get('trips/{trip}', [TripController::class, 'show'])->middleware(['auth:sanctum', 'can:show trip']);
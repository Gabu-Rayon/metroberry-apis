<?php

use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


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

Route::get('vehicles', [VehicleController::class, 'index'])->middleware(['auth:sanctum', 'can:view vehicles']);
Route::get('vehicles/{vehicle}', [VehicleController::class, 'show'])->middleware(['auth:sanctum', 'can:show vehicle']);
Route::post('vehicles', [VehicleController::class, 'store'])->middleware(['auth:sanctum', 'can:create vehicles']);
Route::put('vehicles/{vehicle}', [VehicleController::class, 'update'])->middleware(['auth:sanctum', 'can:edit vehicle']);
Route::delete('vehicles/{vehicle}', [VehicleController::class, 'destroy'])->middleware(['auth:sanctum', 'can:delete vehicle']);
Route::post('assign-driver/{vehicle}', [VehicleController::class, 'assign_driver'])->middleware(['auth:sanctum', 'can:assign driver']);

Route::get('organisation', [OrganisationController::class, 'index'])->middleware(['auth:sanctum', 'can:view organisation']);
Route::post('organisation', [OrganisationController::class, 'store'])->middleware(['auth:sanctum', 'can:create organisation']);

// Route::get('customerLogin', [CustomerLoginController::class, 'index'])->middleware(['auth:sanctum', 'can:can login']);
// Route::post('customerLogin', [CustomerLoginController::class, 'store'])->middleware(['auth:sanctum', 'can:can view login page']);

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
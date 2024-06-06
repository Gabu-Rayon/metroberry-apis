<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\OrganisationController;

Route::get('/user', function (Request $request) {
    return $request->user();
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

Route::get('organisation', [OrganisationController::class, 'index'])->middleware(['auth:sanctum', 'can:view organisation']);
Route::post('organisation', [OrganisationController::class, 'store'])->middleware(['auth:sanctum', 'can:create organisation']);
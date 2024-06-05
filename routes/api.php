<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AddRouteController;
use App\Http\Controllers\OrganisationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::get('vehicles', [VehicleController::class, 'index'])->middleware(['auth:sanctum', 'can:view vehicles']);
Route::post('vehicles', [VehicleController::class, 'store'])->middleware(['auth:sanctum', 'can:create vehicles']);

Route::get('routes', [AddRouteController::class, 'index'])->middleware(['auth:sanctum', 'can:view routes']);
Route::post('routes', [AddRouteController::class, 'store'])->middleware(['auth:sanctum', 'can:create route']);

Route::get('organisation', [OrganisationController::class, 'index'])->middleware(['auth:sanctum', 'can:view organisations']);
Route::post('organisation', [OrganisationController::class, 'store'])->middleware(['auth:sanctum', 'can:create organisation']);

Route::post('organisation/addCustomer', [OrganisationController::class, 'addCustomer'])->middleware(['auth:sanctum', 'can:create a customer']);
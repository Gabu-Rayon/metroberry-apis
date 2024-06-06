<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerLoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('customerLogin', [CustomerLoginController::class,'customerLogin']);

// Route::get('customerLogin', [CustomerLoginController::class, 'index'])->middleware(['auth:sanctum', 'can:can login']);
// Route::post('customerLogin', [CustomerLoginController::class, 'store'])->middleware(['auth:sanctum', 'can:can view login page']);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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

Route::post('customerLogin', [CustomerController::class,'customerLogin']);
Route::post('customerUpdateProfile/{id}/', [CustomerController::class, 'customerUpdateProfile']);

Route::post('password/email', [CustomerController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [CustomerController::class, 'reset']);

Route::post('customerUpdateProfileAvatar', [CustomerController::class, 'customerUpdateProfileAvatar']);
Route::post('customerBookTrip', [CustomerController::class, 'bookTrip']);
Route::post('customerCancelTrip', [CustomerController::class, 'cancelTrip']);
Route::post('customerBookTrip', [CustomerController::class, 'bookTrip']);
Route::post('customerUpdateBookedTrip', [CustomerController::class, 'updateBookedTrip']);

Route::post('verifyEmail', [CustomerController::class, 'verifyEmail']);
Route::post('resendEmailVerification', [CustomerController::class, 'resendEmailVerification']);
Route::post('verifyPhone', [CustomerController::class, 'verifyPhone']);
Route::post('resendPhoneVerification', [CustomerController::class, 'resendPhoneVerification']);


// Route::get('customerLogin', [CustomerController::class, 'index'])->middleware(['auth:sanctum', 'can:can login']);
// Route::post('customerLogin', [CustomerController::class, 'store'])->middleware(['auth:sanctum', 'can:can view login page']);
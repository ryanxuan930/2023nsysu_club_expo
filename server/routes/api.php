<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// User api routes
Route::apiResource('users', UserController::class);
// Admin api routes
Route::apiResource('admins', AdminController::class);
// Club api routes
Route::apiResource('clubs', ClubController::class);
// Coupon api routes
Route::apiResource('coupons', CouponController::class);
// Bulletin api routes
Route::apiResource('bulletins', BulletinController::class);
// User auth api routes
Route::prefix('auth/user')->group(function () {
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('exists', [UserAuthController::class, 'exists']);
    Route::get('info', [UserAuthController::class, 'user']);
    Route::post('logout', [UserAuthController::class, 'logout']);
});

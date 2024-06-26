<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\BroadcastController;

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
Route::post('coupons/all', [CouponController::class, 'showByArray']);
// Bulletin api routes
Route::apiResource('bulletins', BulletinController::class);
// Broadcast api routes
Route::apiResource('broadcasts', BroadcastController::class);
// User auth api routes
Route::prefix('auth/user')->group(function () {
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('exists', [UserAuthController::class, 'exists']);
    Route::get('info', [UserAuthController::class, 'user']);
    Route::get('qrcode', [UserAuthController::class, 'qrcode']);
    Route::get('status', [UserAuthController::class, 'status']);
    Route::post('logout', [UserAuthController::class, 'logout']);
});
// Admin auth api routes
Route::prefix('auth/admin')->group(function () {
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout']);
    Route::get('info', [AdminAuthController::class, 'admin']);
    Route::post('decode', [AdminAuthController::class, 'decode']);
    Route::post('input', [AdminAuthController::class, 'input']);
    Route::post('redeem', [AdminAuthController::class, 'redeem']);
    Route::get('alert', [AdminAuthController::class, 'alert']);
});

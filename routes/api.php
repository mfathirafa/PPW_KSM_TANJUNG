<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TagihanAdminController;
use App\Http\Controllers\Admin\PembayaranAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\User\TagihanUserController;
use App\Http\Controllers\User\PembayaranUserController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

/*
|--------------------------------------------------------------------------
| USER (AUTHENTICATED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/tagihan', [TagihanUserController::class, 'index']);
    Route::post('/pembayaran/{tagihan}', [PembayaranUserController::class, 'store']);
    Route::get('/pembayaran/riwayat', [PembayaranUserController::class, 'riwayat']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index']);

    Route::get('/admin/tagihan', [TagihanAdminController::class, 'index']);
    Route::post('/admin/tagihan', [TagihanAdminController::class, 'store']);

    Route::get('/admin/pembayaran', [PembayaranAdminController::class, 'index']);
    Route::post('/admin/pembayaran/{id}/accept', [PembayaranAdminController::class, 'accept']);
    Route::post('/admin/pembayaran/{id}/reject', [PembayaranAdminController::class, 'reject']);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TagihanAdminController;
use App\Http\Controllers\Admin\PembayaranAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\User\TagihanUserController;
use App\Http\Controllers\User\PembayaranUserController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\ReportAdminController;

use App\Http\Controllers\User\ProfileController;
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

    Route::get('/user/profile', [ProfileController::class, 'show']);
    Route::post('/user/profile', [ProfileController::class, 'update']);

    Route::get('/tagihan', [TagihanUserController::class, 'index']);

    Route::post('/pembayaran', [PembayaranUserController::class, 'store']);
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

    Route::get('/admin/users', [UserAdminController::class, 'index']);

    Route::get('/admin/pelanggan', [PelangganController::class, 'store']);

    Route::get('/admin/tagihan', [TagihanAdminController::class, 'index']);
    Route::post('/admin/tagihan', [TagihanAdminController::class, 'store']);

    Route::get('/admin/pembayaran', [PembayaranAdminController::class, 'index']);
    Route::post('/admin/pembayaran/{id}/accept', [PembayaranAdminController::class, 'accept']);
    Route::post('/admin/pembayaran/{id}/reject', [PembayaranAdminController::class, 'reject']);

    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/admin/reports/finance', [ReportAdminController::class, 'finance']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

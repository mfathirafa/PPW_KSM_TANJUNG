<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TagihanAdminController;
use App\Http\Controllers\Admin\PembayaranAdminController;


Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    // Tagihan
    Route::post('/admin/tagihan', [TagihanAdminController::class, 'store']);
    Route::get('/admin/tagihan', [TagihanAdminController::class, 'index']);

    // Pembayaran
    Route::get('/admin/pembayaran', [PembayaranAdminController::class, 'index']);
    Route::post('/admin/pembayaran/{id}/accept', [PembayaranAdminController::class, 'accept']);
    Route::post('/admin/pembayaran/{id}/reject', [PembayaranAdminController::class, 'reject']);
});
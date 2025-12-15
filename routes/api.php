<?php
use App\Http\Controllers\AuhthConroller;

Route::post('/send-otp', [AuhthConroller::class, 'sendOtp']);
Route::post('/verify-otp', [AuhthConroller::class, 'verifyOtp']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});
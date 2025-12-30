<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\OtpWebController;
use App\Http\Controllers\Web\User\UserDashboardController;
use App\Http\Controllers\Web\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC LOGIN PAGES
|--------------------------------------------------------------------------
*/

// CUSTOMER LOGIN
Route::get('/login', fn () => view('user.auth.whatsapp-login'))->name('login');
Route::get('/verify-code', fn () => view('user.auth.verify-code'));

// ADMIN LOGIN
Route::get('/admin/whatsapp-login', fn () => view('admin.auth.whatsapp-login'));
Route::get('/admin/verify-code', fn () => view('admin.auth.verify-code'));


/*
|--------------------------------------------------------------------------
| OTP ACTION (SHARED)
|--------------------------------------------------------------------------
*/
Route::post('/whatsapp/send-otp', [OtpWebController::class, 'send']);
Route::post('/whatsapp/verify-otp', [OtpWebController::class, 'verify']);


/*
|--------------------------------------------------------------------------
| CUSTOMER AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index']);
    Route::get('/bills', [UserDashboardController::class, 'bills']);
    Route::get('/history', [UserDashboardController::class, 'history']);
    Route::get('/profile', [UserDashboardController::class, 'profile']);
});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});

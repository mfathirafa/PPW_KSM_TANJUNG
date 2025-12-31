<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\OtpWebController;
use App\Http\Controllers\Web\User\UserDashboardController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\CustomerController;
use App\Http\Controllers\Web\Admin\HistoryController;
use App\Http\Controllers\Web\Admin\ConfirmationController;
use App\Http\Controllers\Web\Admin\FinanceReportController;
use App\Http\Controllers\Web\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| LOGIN AWAL (ROLE PICKER)
|--------------------------------------------------------------------------
*/
Route::get('/login', fn () => view('auth.login'))
    ->name('login');

/*
|--------------------------------------------------------------------------
| LOGIN CUSTOMER (WHATSAPP)
|--------------------------------------------------------------------------
*/
Route::get('/login/customer/whatsapp', fn () => view('user.auth.whatsapp-login'))
    ->name('customer.login');

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN (WHATSAPP)
|--------------------------------------------------------------------------
*/
Route::get('/login/admin/whatsapp', fn () => view('admin.auth.whatsapp-login'))
    ->name('admin.login');

/*
|--------------------------------------------------------------------------
| OTP - SEND (UMUM)
|--------------------------------------------------------------------------
*/
Route::post('/whatsapp/send-otp', [OtpWebController::class, 'send'])
    ->name('otp.send');

/*
|--------------------------------------------------------------------------
| OTP - VERIFY PAGE
|--------------------------------------------------------------------------
*/
Route::get('/verify-code', [OtpWebController::class, 'showUserVerify'])
    ->name('user.verify');

Route::get('/admin/verify-code', [OtpWebController::class, 'showAdminVerify'])
    ->name('admin.verify');

/*
|--------------------------------------------------------------------------
| OTP - VERIFY ACTION
|--------------------------------------------------------------------------
*/
Route::post('/whatsapp/verify-otp', [OtpWebController::class, 'verifyUserOtp'])
    ->name('otp.verify.user');

Route::post('/admin/verify-otp', [OtpWebController::class, 'verifyAdminOtp'])
    ->name('otp.verify.admin');

/*
|--------------------------------------------------------------------------
| CUSTOMER AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/bills', [UserDashboardController::class, 'bills']);
    Route::get('/history', [UserDashboardController::class, 'history']);
    Route::get('/profile', [UserDashboardController::class, 'profile']);

    Route::post('/logout', [UserDashboardController::class, 'logout'])
        ->name('user.logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index']);

    Route::get('/admin/customers', [CustomerController::class, 'index'])
        ->name('admin.customers');
    Route::post('/admin/customers', [CustomerController::class, 'store']);
    Route::put('/admin/customers/{pelanggan}', [CustomerController::class, 'update']);
    Route::delete('/admin/customers/{pelanggan}', [CustomerController::class, 'destroy']);

    Route::get('/admin/history', [HistoryController::class, 'index'])
        ->name('admin.history');
    Route::get('/admin/history/{pembayaran}', [HistoryController::class, 'show']);

    Route::get('/admin/confirmations', [ConfirmationController::class, 'index']);
    Route::post('/admin/confirmations/{pembayaran}/accept', [ConfirmationController::class, 'accept']);
    Route::post('/admin/confirmations/{pembayaran}/reject', [ConfirmationController::class, 'reject']);

    Route::get('/admin/reports/finance', [FinanceReportController::class, 'index']);
    Route::get('/admin/reports/finance/csv', [FinanceReportController::class, 'exportCsv']);
    Route::get('/admin/reports/finance/pdf', [FinanceReportController::class, 'exportPdf']);

    Route::get('/admin/settings', [SettingController::class, 'index']);

    Route::post('/logout', [DashboardController::class, 'logout'])
        ->name('admin.logout');
});
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
Route::get('/login', fn () => view('auth.login'))->name('login');
/*
|--------------------------------------------------------------------------
| PUBLIC LOGIN PAGES
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| LOGIN CUSTOMER
|--------------------------------------------------------------------------
*/
Route::get('/login/customer/whatsapp', fn () => view('user.auth.whatsapp-login'));
Route::get('/login/customer/verify', fn () => view('user.auth.verify-code'));

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/login/admin/whatsapp', fn () => view('admin.auth.whatsapp-login'));
Route::get('/login/admin/verify', fn () => view('admin.auth.verify-code'));


/*
|--------------------------------------------------------------------------
| OTP ACTION
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
    Route::delete('/logout', [UserDashboardController::class, 'logout'])->name('user.logout');
});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);

    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers');
    Route::post('/admin/customers', [CustomerController::class, 'store'])->name('admin.customers.store');
    Route::put('/admin/customers/{pelanggan}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/admin/customers/{pelanggan}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    Route::get('/admin/history', [HistoryController::class, 'index'])->name('admin.history');
    Route::get('/admin/history/{pembayaran}', [HistoryController::class, 'show'])->name('admin.history.invoice');

    Route::get('/admin/confirmations', [ConfirmationController::class, 'index']);
    Route::post('admin/confirmations/{pembayaran}/accept', [ConfirmationController::class, 'accept'])->name('admin.confirmations.accept');
    Route::post('admin/confirmations/{pembayaran}/reject', [ConfirmationController::class, 'reject'])->name('admin.confirmations.reject');

    Route::get('/admin/reports/finance', [FinanceReportController::class, 'index']);
    Route::get('/admin/reports/finance/csv', [FinanceReportController::class, 'exportCsv'])->name('admin.reports.finance.csv');
    Route::get('/admin/reports/finance/pdf', [FinanceReportController::class, 'exportPdf'])->name('admin.reports.finance.pdf');

    Route::get('/admin/settings', [SettingController::class, 'index']);

    Route::delete('/logout', [DashboardController::class, 'logout'])->name('admin.logout');
});

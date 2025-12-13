<?php

use Illuminate\Support\Facades\Route;


Route::get('/admin/login', function () {
    return view('admin.auth.login');
});

Route::get('/admin/register', function () {
    return view('admin.auth.register');
});

Route::get('/admin/whatsapp-login', function () {
    return view('admin.auth.whatsapp-login');
});

Route::get('/admin/verify-code', function () {
    return view('admin.auth.verify-code');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/customers', function () {
    return view('admin.customers.index');
});

Route::get('/admin/reports/finance', function () {
    return view('admin.reports.finance');
});

Route::get('/admin/confirmations', function () {
    return view('admin.confirmations.index');
});

Route::get('/admin/settings', function () {
    return view('admin.settings.index');
});

Route::get('/admin/history', function () {
    return view('admin.history.index');
});


Route::get('/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/bills', function () {
    return view('user.bills.index');
});

Route::get('/history', function () {
    return view('user.history.index'); 
});

// Route untuk Halaman Profil
Route::get('/profile', function () {
    return view('user.profile.index'); 
});
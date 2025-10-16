<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/halo', function () {
    return "Halo Rafa! Laravel kamu sudah jalan 😄";
});

Route::get('/tentang', function () {
    return "Ini halaman KSM Tanjung";
});

Route::get('/contuct', function() {
    return "Silahkan hubungi kami pada +62-812-345-678";
});

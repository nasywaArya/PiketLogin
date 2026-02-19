<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLoginController;



// form login
Route::get('/login', [UserLoginController::class, 'formlogin'])->name('login');

// proses login
Route::post('/login', [UserLoginController::class, 'login'])->name('login.proses');

// logout
Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');



Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {

        return view('Admin.dashboard');

    })->name('admin.dashboard');

});
Route::prefix('user')->group(function () {

    Route::get('/dashboard', function () {

        return view('User.dashboard');

    })->name('user.dashboard');


    Route::get('/pemberitahuan', function () {

        return view('User.pemberitahuan');

    })->name('user.pemberitahuan');


    Route::get('/jadwal', function () {

        return view('User.jadwal');

    })->name('user.jadwal');


    Route::get('/laporan', function () {

        return view('User.laporan');

    })->name('user.laporan');

});


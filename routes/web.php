<?php

use App\Http\Controllers\DivisionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('formlogin');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/managedivision/mdivision', function () {
    return view('admin.mdivision.mdivision');
});

Route::resource('divisions', DivisionController::class);
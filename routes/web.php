<?php

use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ManageUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('formlogin');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

// Route::get('/managedivision/mdivision', function () {
//     return view('admin.mdivision.mdivision');
// });

Route::resource('divisions', DivisionController::class);




// Route::get('/manageusers/musers', function () {
//     return view('admin.musers.musers');
// });

Route::resource('manageusers', ManageUserController::class);


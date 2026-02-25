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

 
 

Route::resource('divisions', DivisionController::class);
Route::resource('manageusers', ManageUserController::class);
 

Route::resource('divisions', DivisionController::class);


 
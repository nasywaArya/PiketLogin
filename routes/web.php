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
<<<<<<< HEAD

Route::resource('divisions', DivisionController::class);
Route::resource('manageusers', ManageUserController::class);
=======

Route::resource('divisions', DivisionController::class);



 ee

 

>>>>>>> 1fb9fc37dc9c4163de2f9a8141eae7a32fd612ca

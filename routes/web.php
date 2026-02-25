<?php

use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ManageUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// ================ USER ROUTES ================
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/jadwal', [UserController::class, 'jadwal'])->name('jadwal');
    Route::get('/laporan', [UserController::class, 'laporan'])->name('laporan');
    Route::post('/upload-foto', [UserController::class, 'uploadFoto'])->name('upload.foto');
    Route::get('/schedule/{scheduleId}/detail', [UserController::class, 'getScheduleDetail'])->name('schedule.detail');
    // TAMBAHKAN ROUTE INI!
    Route::post('/konfirmasi-jadwal', [UserController::class, 'konfirmasiJadwal'])->name('konfirmasi.jadwal');
});



// ================ ADMIN ROUTES ================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/journal/{id}/edit', [AdminController::class, 'getJournal'])->name('journal.edit');
    Route::post('/journal/{id}/update', [AdminController::class, 'updateJournal'])->name('journal.update');
    });
    Route::post('/admin/schedules/store', [AdminController::class, 'schedulesStore'])->name('admin.schedules.store');
Route::put('/admin/schedules/{id}', [AdminController::class, 'schedulesUpdate'])->name('admin.schedules.update');
 Route::post('/reports/{id}/approve', [AdminController::class, 'reportsApprove'])->name('reports.approve');
    Route::post('/reports/{id}/reject', [AdminController::class, 'reportsReject'])->name('reports.reject');
    
// EXCEL
    Route::get('/admin/export-excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
// ================ ROOT ================
Route::get('/', function () {
    return redirect('/user/dashboard');
});


// ================ SWITCH USER ================
Route::get('/set-user/{id}', function($id) {
    session(['active_user_id' => $id]);
    return redirect('/user/dashboard')->with('success', "Berpindah ke user ID: $id");
})->name('set.user');

Route::get('/switch-user', function() {
    return view('userSwitch');
})->name('switch.user');
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


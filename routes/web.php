<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [LoginController::class, 'showLoginForm']);

//register
Route::get('register',[RegisterController::class,'showRegisterForm'])->name('register');
Route::post('register/proses',[RegisterController::class,'prosesRegister'])->name('prosesRegister');

//login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

//Login authenticate
Route::post('login/prosesAuth', [LoginController::class, 'authenticate'])->name('prosesAuthentifikasi');

//dashboard
Route::get('karyawan/dashboard', function () {
    return view('dashboard_karyawan');
})->middleware('auth')->name('dashboard');

Route::get('admin/dashboard', function(){
    return view('dashboard_admin');
});

//logout
Route::get('logout',[LoginController::class,'logout'])->name('logout');

//absensi kamera
Route::get('absensiKamera', [App\Http\Controllers\AbsensiKameraController::class, 'index'])->middleware('auth')->name('absensiKamera');
Route::post('absensiKamera/upload', [App\Http\Controllers\AbsensiKameraController::class, 'upload'])->middleware('auth')->name('absensiKamera.upload');


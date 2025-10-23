<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AbsensiKameraController;
use App\Http\Controllers\KaryawanController;

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
})->name('admin_dashboard');

//logout
Route::get('logout',[LoginController::class,'logout'])->name('logout');

//absensi kamera
Route::get('absensiKamera', [AbsensiKameraController::class, 'index'])->middleware('auth')->name('absensiKamera');
Route::post('absensiKamera/upload', [AbsensiKameraController::class, 'upload'])->middleware('auth')->name('absensiKamera.upload');

//data karyawan
Route::get('admin/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan');

//tambah data karyawan
Route::post('admin/tambahkaryawan/proses',[KaryawanController::class,'prosesTambahKaryawan'])->name('prosesTambahKaryawan');

//hapus data karyawan
Route::get('admin/hapuskaryawan/{id}', [KaryawanController::class, 'hapusKaryawan'])->name('hapusKaryawan');

//update data karyawan
Route::post('admin/updatekaryawan/proses',[KaryawanController::class,'prosesUpdateKaryawan'])->name('prosesEditKaryawan');
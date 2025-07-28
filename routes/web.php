<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\Admin\KonfirmasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Grup route yang hanya bisa diakses setelah login (baik admin atau pelanggan)
Route::middleware(['check.auth'])->group(function () {

    // Route untuk pelanggan
    Route::get('tagihan-saya', [TagihanController::class, 'index'])->name('tagihan.index');
    Route::get('bayar/{tagihan}', [TagihanController::class, 'showPembayaran'])->name('pembayaran.show');
    Route::post('bayar/{tagihan}', [TagihanController::class, 'prosesPembayaran'])->name('pembayaran.proses');
    Route::get('upload-bukti/{tagihan}', [TagihanController::class, 'showUploadForm'])->name('pembayaran.upload.show');
    Route::post('upload-bukti/{tagihan}', [TagihanController::class, 'storeUpload'])->name('pembayaran.upload.store');
    Route::get('struk/{tagihan}', [TagihanController::class, 'cetakStruk'])->name('struk.cetak');

    // Grup route yang hanya bisa diakses oleh admin
    Route::middleware(['is.admin'])->group(function() {
        Route::resource('penggunaan', PenggunaanController::class);
        Route::get('konfirmasi-pembayaran', [KonfirmasiController::class, 'index'])->name('admin.pembayaran.index');
        Route::post('konfirmasi-pembayaran/{tagihan}', [KonfirmasiController::class, 'konfirmasi'])->name('admin.pembayaran.konfirmasi');
    });
});
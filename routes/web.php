<?php

use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/siswa');
});

Route ::resource('siswa', App\Http\Controllers\SiswaController::class);
Route::get('/nilai', [App\Http\Controllers\SiswaController::class, 'nilaiIndex']);
Route::post('/nilai/{siswa}', [App\Http\Controllers\SiswaController::class, 'nilaiUpdate']);
Route::get('/dashboard', [App\Http\Controllers\SiswaController::class, 'dashboard']);
Route ::resource('kelas', App\Http\Controllers\KelasController::class);
Route ::resource('spp', App\Http\Controllers\SppController::class);

Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');

Route::get('/pembayaran/{pembayaran}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
Route::put('/pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->name('pembayaran.update');

Route::delete('/pembayaran/{pembayaran}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

// riwayat pembayaran per siswa
Route::get('/pembayaran/siswa/{siswa}', [PembayaranController::class, 'siswa'])->name('pembayaran.siswa');

Route::put('/pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->name('pembayaran.update');
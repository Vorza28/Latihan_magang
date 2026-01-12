<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/siswa');
});

Route ::resource('siswa', App\Http\Controllers\SiswaController::class);
Route::get('/nilai', [App\Http\Controllers\SiswaController::class, 'nilaiIndex']);
Route::post('/nilai/{siswa}', [App\Http\Controllers\SiswaController::class, 'nilaiUpdate']);
Route::get('/dashboard', [App\Http\Controllers\SiswaController::class, 'dashboard']);
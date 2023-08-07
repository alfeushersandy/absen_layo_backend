<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



/**
 * Route API Auth
 */
Route::post('/login', [AuthController::class, 'login'])->name('api.customer.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.customer.register');
Route::get('/user', [AuthController::class, 'getUser'])->name('api.customer.user');

Route::get('/absen', [AbsenController::class, 'index'])->name('api.absen.index');
Route::get('/karyawan', [AbsenController::class, 'getKaryawan'])->name('api.absen.getkaryawan');
Route::get('/jenisAbsen', [AbsenController::class, 'getJenisAbsen'])->name('api.absen.getJenisAbsen');
Route::post('/absen', [AbsenController::class, 'store'])->name('api.absen.store');
Route::put('/absen/{id}', [AbsenController::class, 'approve'])->name('api.absen.approve');



<?php

use App\Http\Controllers\Admin\AbsenController;
use App\Http\Controllers\Admin\DepartemenController;
use App\Http\Controllers\Admin\IjinController;
use App\Http\Controllers\Admin\JenisAbsenController;
use App\Http\Controllers\Admin\JenisIzinController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReportIjinController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\AbsenController as ApiAbsenController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function(){
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/karyawans', KaryawanController::class);
    Route::resource('/departemen', DepartemenController::class);
    Route::resource('/jenisizin', JenisIzinController::class);
    Route::resource('/jenisabsen', JenisAbsenController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/absens', IjinController::class);
    Route::get('/absens/{absen}/approve', [IjinController::class, 'approve'])->name('absens.approve');
    Route::get('/absens/{absen}/reject', [IjinController::class, 'rejected'])->name('absens.reject');
    Route::resource('/check', AbsenController::class);
    Route::post('/check/import', [AbsenController::class, 'import'])->name('check.import');
    Route::controller(ReportIjinController::class)->prefix('/report')->as('report.')->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/filter', 'filter')->name('filter');
      });
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PermohonanCutiController;
use App\Http\Controllers\UnitController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
        return redirect()->Route('login');
    });

//Auth
Route::get('/login', [AuthController::class, 'login_view'])->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Reset Password
Route::get('/resetpassword', [AuthController::class, 'reset_password'])->name('reset.view');

Route::get('/editprofile', [KaryawanController::class, 'editprofile'])->name('editprofile');

//Dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


Route::middleware('auth')->group(function () {
        Route::middleware('auth','role:pegawai')->group(function () {
        Route::get('/formpegawai', [KaryawanController::class, 'index'])->name('formpegawai');
        Route::get('/unit', [UnitController::class, 'view_unit'])->name('unit');
    });
    Route::middleware('auth','check:admin')->group(function () {
        Route::get('/formedit/{id}', [KaryawanController::class, 'edit'])->name('formedit');
        Route::post('/formedit', [KaryawanController::class, 'update'])->name('updatepegawai');
        Route::get('/hapuspegawai/{id}', [KaryawanController::class, 'destroy'])->name('hapuspegawai');
        Route::get('/formtambah', [KaryawanController::class , 'formtambahpegawai'])->name('tambahpegawai');
        Route::post('/tambahpegawai', [KaryawanController::class , 'tambah'])->name('tambah');
    });

    //Permohonan
    Route::post('/permohonancuti', [PermohonanCutiController::class , 'tambahPermohonan'])->name('permohonancuti');
    Route::post('/editpermohonan/{id_permohonan}', [PermohonanCutiController::class , 'editPermohonan'])->name('edit.permohonancuti');
    Route::get('/permohonan', [PermohonanCutiController::class, 'permohonan'])->name('permohonan');
    Route::get('/riwayat-permohonan', [PermohonanCutiController::class, 'riwayat_permohonan'])->middleware('wadirku:recent')->name('riwayat.permohonan');
    Route::get('/permohonandisetujui', [PermohonanCutiController::class, 'permohonan_disetujui'])->name('permohonandisetujui');
    Route::get('/permohonanditolak', [PermohonanCutiController::class, 'permohonan_ditolak'])->name('permohonanditolak');
});

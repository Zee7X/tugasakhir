<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Auth;
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
        return redirect()->Route('login');
    });

//Auth
Route::get('/login', [AuthController::class, 'login_view'])->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

//Route Data Pegawai/Admin Side 
Route::get('/formpegawai', [KaryawanController::class, 'index'])->name('formpegawai');
Route::get('/formedit/{id}', [KaryawanController::class, 'edit'])->name('formedit');
Route::post('/formedit', [KaryawanController::class, 'update'])->name('updatepegawai');
Route::get('/hapuspegawai/{id}', [KaryawanController::class, 'destroy'])->name('hapuspegawai');
Route::get('/formtambah', [DashboardController::class , 'formtambahpegawai'])->name('tambahpegawai');


//Permohonan
Route::get('/permohonan', [DashboardController::class, 'datapermohonan'])->name('permohonan');
Route::get('/permohonandisetujui', [DashboardController::class, 'permohonandisetujui'])->name('permohonandisetujui');
Route::get('/permohonanditolak', [DashboardController::class, 'permohonanditolak'])->name('permohonanditolak');

// middleware(['role:bagiankepegawaian'])->
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PermohonanCutiController;
use App\Http\Controllers\RiwayatPermohonanController;
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


// Route::get('/resetpassword', [AuthController::class, 'reset_password'])->name('reset.view');
//Profile
Route::get('/profile', [KaryawanController::class, 'viewprofile'])->name('profile');
Route::post('/editprofile/{id}', [KaryawanController::class, 'editprofile'])->name('editprofile');

//Dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


Route::middleware('auth:sanctum')->group(function () {
        Route::middleware('auth','role:pegawai')->group(function () {
        Route::get('/pegawai', [KaryawanController::class, 'index'])->name('pegawai');
        Route::post('/upload-pegawai', [ImportController::class, 'import_pegawai'])->name('import_pegawai');
    });
    Route::middleware('auth','check:admin')->group(function () {
        Route::get('/edit-pegawai/{id}', [KaryawanController::class, 'edit'])->name('edit.pegawai');
        Route::post('/formedit', [KaryawanController::class, 'update'])->name('updatepegawai');
        Route::get('/hapuspegawai/{id}', [KaryawanController::class, 'destroy'])->name('hapuspegawai');
        Route::get('/tambah-pegawai', [KaryawanController::class , 'formtambahpegawai'])->name('tambah.pegawai');
        Route::get('/reset_tahunan', [KaryawanController::class , 'reset_tahunan'])->name('reset_tahunan');
        Route::post('/tambahpegawai', [KaryawanController::class , 'tambah'])->name('tambah');
        Route::get('/unit', [UnitController::class, 'view_unit'])->name('unit');
        Route::post('/tambahunit', [UnitController::class , 'tambahunit'])->name('tambahunit');
        Route::get('/hapusunit/{id}', [UnitController::class, 'hapusunit'])->name('hapusunit');
        Route::post('/editunit/{id}', [UnitController::class , 'editunit'])->name('edit.unit');
    });

    //Permohonan
    Route::post('/permohonancuti', [PermohonanCutiController::class , 'tambahPermohonan'])->name('permohonancuti');
    Route::post('/editpermohonan/{id_permohonan}', [PermohonanCutiController::class , 'editPermohonan'])->name('edit.permohonancuti');
    Route::post('/setujuipermohonan/{id}', [PermohonanCutiController::class , 'setujui_permohonan'])->name('setujui.permohonancuti');
    Route::post('/tolakpermohonan/{id_permohonan}', [PermohonanCutiController::class , 'tolak_permohonan'])->name('tolak.permohonancuti');
    Route::post('/batalkanpermohonan/{id_permohonan}', [PermohonanCutiController::class , 'batalkan_permohonan'])->name('batal.permohonancuti');
    Route::get('/permohonan', [PermohonanCutiController::class, 'permohonan'])->name('permohonan');
    //Riwayat Permohonan
    Route::get('/permohonanku', [RiwayatPermohonanController::class, 'permohonanKu'])->name('tambah.permohonan');
    Route::get('/riwayat-permohonan', [RiwayatPermohonanController::class, 'riwayat_permohonan'])->middleware('wadirku:recent')->name('riwayat.permohonan');
    Route::get('/permohonan-disetujui', [RiwayatPermohonanController::class, 'permohonan_disetujui'])->name('permohonandisetujui');
    Route::get('/permohonan-ditolak', [RiwayatPermohonanController::class, 'permohonan_ditolak'])->name('permohonanditolak');
    Route::get('/permohonan-dibatalkan', [RiwayatPermohonanController::class, 'permohonan_dibatalkan'])->name('permohonandibatalkan');
    Route::post('/permohonan-disetujui/export_excel', [RiwayatPermohonanController::class, 'export_excel'])->name('export_excel');
    Route::post('/permohonan-disetujui/export_excel_2', [RiwayatPermohonanController::class, 'export_excel_2'])->name('export_excel_2');
});

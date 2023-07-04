<?php

namespace App\Http\Controllers;

use App\Models\PermohonanModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {

        //Sisa Cuti
        $sisacuti = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
            ->where('hak_cuti.user_id', '=', auth()->user()->id)
            ->get();

        //Disetujui Status Pegawai
        if (auth()->user()->role_id == 1) {
            $disetujui = PermohonanModel::where('status', '=', '4')
                ->where('user_id', '=', auth()->user()->id)
                ->count();
        }
        //Disetujui Status Wadir & Bagian Kepegawaian
        if (auth()->user()->role_id == 4 || auth()->user()->role_id == 3 || auth()->user()->role_id == 5) {
            $disetujui = PermohonanModel::where('status', '=', '4')
                ->count();
        }

        //Disetujui Status Kepala Unit & Direktur
        if (auth()->user()->role_id == 2) {
            $disetujui = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->where('units.id', '=', auth()->user()->unit_id)
                ->where('status', '=', '4')
                ->count();
        }

        //Ditolak Status Pegawai
        if (auth()->user()->role_id == 1) {
            $ditolak = PermohonanModel::where('status', '=', '5')
                ->where('user_id', '=', auth()->user()->id)
                ->count();
        }

        //Ditolak Status Bagian Kepegawaian & Wadir
        if (auth()->user()->role_id == 4 || auth()->user()->role_id == 3  || auth()->user()->role_id == 5) {
            $ditolak = PermohonanModel::where('status', '=', '5')
                ->count();
        }

        //Ditolak Status Kepala Unit & Direktur
        if (auth()->user()->role_id == 2) {
            $ditolak = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->where('units.id', '=', auth()->user()->unit_id)
                ->where('status', '=', '5')
                ->count();
        }

        //Pending Status Pegawai
        if (auth()->user()->role_id == 1) {
            $pending = PermohonanModel::where('status', '=', '1')
                ->where('user_id', '=', auth()->user()->id)
                ->count();
        }

        //Pending Status Admin
        if (auth()->user()->role_id == 4) {
            $pending = PermohonanModel::where([
                ['status', '!=', "4"],
                ['status', '!=', "5"],
                ['status', '!=', "0"]
            ])
                ->count();
        }

        //Pending Status Wadir
        if (auth()->user()->role_id == 3) {
            $pending = PermohonanModel::where('status', '=', '2')
                ->count();
        }

        //Pending Status Kepala Unit
        if (auth()->user()->role_id == 2) {
            $pending = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->where('units.id', '=', auth()->user()->unit_id)
                ->where('status', '=', '1')
                ->count();
        }

        //Pending Status Direktur
        if (auth()->user()->role_id == 5) {
            $pending = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->where('units.id', '=', auth()->user()->unit_id)
                ->where('status', '=', '3')
                ->count();
        }


        //Dashboard Permohonan Cuti Terbaru Pegawai
        if (auth()->user()->role_id == 1) {
            $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('permohonan_cuti.user_id', '=', auth()->user()->id)
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //Dashboard Permohonan Cuti Terbaru Kepala Unit
        if (auth()->user()->role_id == 2) {
            $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where('units.id', '=', auth()->user()->unit_id)
                ->where([
                    ['permohonan_cuti.status', '!=', "2"],
                    ['permohonan_cuti.status', '!=', "3"]
                ])
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //Dashboard Permohonan Cuti Terbaru Wadir
        if (auth()->user()->role_id == 3) {
            $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where([
                    ['permohonan_cuti.status', '!=', "1"],
                    ['permohonan_cuti.status', '!=', "3"]
                ])
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //Dashboard Permohonan Cuti Terbaru Bagian Kepegawaian
        if (auth()->user()->role_id == 4) {
            $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        //Dashboard Permohonan Cuti Terbaru Direktur
        if (auth()->user()->role_id == 5) {
            $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
                ->leftJoin('units', 'users.unit_id', '=', 'units.id')
                ->leftJoin('jenis_cutis', 'permohonan_cuti.jenis_cuti_id', '=', 'jenis_cutis.id')
                ->where([
                    ['permohonan_cuti.status', '!=', "1"],
                    ['permohonan_cuti.status', '!=', "2"]
                ])
                ->orderBy('permohonan_cuti.updated_at', 'DESC')
                ->get();
        }

        return view('Dashboard.Dashboard', compact('dashboard', 'sisacuti', 'disetujui', 'ditolak', 'pending'));
    }
}

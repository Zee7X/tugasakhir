<?php

namespace App\Http\Controllers;

use App\Models\PermohonanModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        $sisacuti = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        ->where('hak_cuti.user_id', '=', auth()->user()->id)
        ->get();

        //Disetujui Status
        if(auth()->user()->role_id == 1){
            $disetujui = PermohonanModel::where('status', '=', 'Disetujui')
            ->where('user_id', '=', auth()->user()->id)
            ->count();
        }
        if(auth()->user()->role_id == 4 || auth()->user()->role_id == 3){
            $disetujui = PermohonanModel::where('status', '=', 'Disetujui')
            ->count();
        }
        if(auth()->user()->role_id == 2){
            $disetujui = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('units.id', '=', auth()->user()->unit_id)
            ->where('status', '=', 'Disetujui')
            ->count();
        }

        //Ditolak Status
        if(auth()->user()->role_id == 1){
            $ditolak = PermohonanModel::where('status', '=', 'Ditolak')
            ->where('user_id', '=', auth()->user()->id)
            ->count();
        }
        if(auth()->user()->role_id == 4 || auth()->user()->role_id == 3){
                $ditolak = PermohonanModel::where('status', '=', 'Ditolak')
                ->count();
        }
        if(auth()->user()->role_id == 2){
            $ditolak = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('units.id', '=', auth()->user()->unit_id)
            ->where('status', '=', 'Ditolak')
            ->count();
        }

        //Pending Status
        if(auth()->user()->role_id == 1){
            $pending = PermohonanModel::where('status', '=', 'Pending')
            ->where('user_id', '=', auth()->user()->id)
            ->count();
        }
        if(auth()->user()->role_id == 4 || auth()->user()->role_id == 3){
                $pending = PermohonanModel::where('status', '=', 'Pending')
                ->count();
        }
        if(auth()->user()->role_id == 2){
            $pending = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('units.id', '=', auth()->user()->unit_id)
            ->where('status', '=', 'Pending')
            ->count();
        }



        if(auth()->user()->role_id == 4 || auth()->user()->role_id == 3){
            $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->orderBy('permohonan_cuti.updated_at', 'DESC')
            ->get();
        }
        if(auth()->user()->role_id == 1){
            $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('permohonan_cuti.user_id', '=', auth()->user()->id )
            ->orderBy('permohonan_cuti.updated_at', 'DESC')
            ->get();
        }
        if(auth()->user()->role_id == 2){
            $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('units.id', '=', auth()->user()->unit_id)
            ->orderBy('permohonan_cuti.updated_at', 'DESC')
            ->get();
        }
        return view('Dashboard.Dashboard', compact('dashboard','sisacuti','disetujui','ditolak','pending'));
    }

}






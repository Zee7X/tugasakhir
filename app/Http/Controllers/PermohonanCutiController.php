<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanCutiController extends Controller
{
    public function datapermohonan()
    {
        $id=Auth::user()->id;

        $permohonan = User::join('permohonan_cuti','users.id','=','permohonan_cuti.user_id')
            ->select('permohonan_cuti.id','users.name','permohonan_cuti.alasan_cuti','permohonan_cuti.tgl_mulai','permohonan_cuti.tgl_akhir','permohonan_cuti.alamat_cuti','permohonan_cuti.status')
            ->where('permohonan_cuti.status','pending')
            ->where('permohonan_cuti.user_id',$id)
            ->get();

        return view('permohonanCuti.index', compact('permohonan'));
    }
}

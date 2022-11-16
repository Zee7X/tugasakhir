<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function formtambahpegawai(){
    return view('pegawai.formtambahpegawai');
   }

    public function formpegawai(){
        return view('pegawai.formpegawai');
    }

    public function editpegawai(){
        return view('pegawai.formedit');
    }

    public function datapermohonan(){
        return view('permohonancuti.index');
    }
    
    public function permohonanditolak(){
        return view('permohonancuti.ditolak');
    }

    public function permohonandisetujui(){
        return view('permohonancuti.disetujui');
    }
}






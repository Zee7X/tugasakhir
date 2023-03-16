<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    //Function View Permohonan
    public function permohonan(){
        return view('permohonancuti.index');
    }
    
    //Function View Reject Cuti
    public function permohonanditolak(){
        return view('permohonancuti.ditolak');
    }

    //Function View Acc Cuti
    public function permohonandisetujui(){
        return view('permohonancuti.disetujui');
    }
}






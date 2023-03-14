<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function permohonan(){
        return view('permohonancuti.index');
    }
    
    public function permohonanditolak(){
        return view('permohonancuti.ditolak');
    }

    public function permohonandisetujui(){
        return view('permohonancuti.disetujui');
    }
}






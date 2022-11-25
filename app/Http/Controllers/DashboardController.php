<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
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






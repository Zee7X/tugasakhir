<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitController extends Controller
{
        //Menampilkan Pegawai
        public function view_unit()
        {
            return view('unit.unit');
        }
}

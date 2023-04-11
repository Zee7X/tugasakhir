<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
        //Menampilkan Pegawai
        public function view_unit()
        {
            $unit = Unit::all();
            return view('unit.unit', compact('unit'));
        }
}

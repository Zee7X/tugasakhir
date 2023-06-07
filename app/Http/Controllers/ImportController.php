<?php

namespace App\Http\Controllers;

use App\Imports\PegawaiImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import_pegawai(Request $request){
        try {
            Excel::import(new PegawaiImport(), $request->file('file'));
            return back()->with('success', 'Data pegawai berhasil diimport');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal');
        }
    }
}

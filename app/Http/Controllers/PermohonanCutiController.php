<?php

namespace App\Http\Controllers;

use App\Models\PermohonanModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanCutiController extends Controller
{
   public function store(Request $request)
   {
       $id = Auth()->user()->id;
       $data = User::select('hak_cuti')->where('id',$id)->get();

       $sisaCuti =$data[0]->hak_cuti; 

       $tglMulai = date_create($request->tgl_mulai);
       $tglAkhir = date_create($request->tgl_akhir);
       $durasi = date_diff($tglMulai,$tglAkhir);

       $jumlahCuti = $sisaCuti - $durasi->days;


       if($jumlahCuti < 0){
        return redirect()->route('permohonan')->with(['error' => 'Maaf anda tidak bisa mengajukan cuti karena sisa cuti anda sudah habis']);
    }else{
        
        PermohonanModel::insert([
            'user_id' => Auth::id(),
            'alasan_cuti' => $request->alasan_cuti,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'alamat_cuti' => $request->alamat_cuti,
            'status' => 'Pending',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // $user = User::findOrfail($id);

        // User::insert([
        //     'nip' => $user->nip,
        //     'name' => $user->name,
        //     'jenis_kelamin' => $user->jenis_kelamin,
        //     'role_id' => $user->role_id,
        //     'unit_id' => $user->unit_id,
        //     'hak_cuti' => $jumlahCuti
        // ])->where('id', $id)->save();
        
        return redirect()->route('permohonan')->with(['success' => 'Berhasil Mengajukan Permohonan Cuti']);
    }
   }
}

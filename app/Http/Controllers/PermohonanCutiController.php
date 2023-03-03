<?php

namespace App\Http\Controllers;

use App\Models\HakCuti;
use App\Models\PermohonanModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanCutiController extends Controller
{
   public function tambahPermohonan(Request $request)
   {
       $id = Auth()->user()->id;
       $data = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
       ->where('hak_cuti.user_id', '=', $id)->get();

       $sisaCuti =$data[0]->hak_cuti; 

       $tglMulai = date_create($request->tgl_mulai);
       $tglAkhir = date_create($request->tgl_akhir);
       $durasi = date_diff($tglMulai,$tglAkhir);

       $jumlahCuti = $sisaCuti - $durasi->days;


       if($jumlahCuti < 0){
        return redirect()->route('permohonan')->with(['error' => 'Maaf sisa cuti anda sudah habis']);
    }else{
        if($durasi->days <= 0){
            return redirect()->route('permohonan')->with(['error' => 'Silahkan Periksa kembali tanggal cuti']);
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

            $hak_cuti = ([
                'hak_cuti' => $jumlahCuti,
            ]);

            HakCuti::whereId($id)->update($hak_cuti);

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
}

<?php

namespace App\Http\Controllers;

use App\Models\HakCuti;
use App\Models\PermohonanModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermohonanCutiController extends Controller
{

   //Tambah Permohonan Cuti 
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
                return redirect()->route('permohonan')->with(['error' => 'Silahkan periksa kembali tanggal cuti']);
            }else{
                $validasiData = Validator::make($request->all(), [
                    'alasan_cuti' => 'required',
                    'tgl_mulai' => 'required',
                    'tgl_akhir' => 'required',
                    'alamat_cuti' => 'required|max:255',
                ]);
                if($validasiData->fails()){
                    return back()->withInput()->with(['error' => 'Silahkan periksa alasan cuti!']);
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
                
                return redirect()->route('permohonan')->with(['success' => 'Berhasil Mengajukan Permohonan Cuti']);
            }
            }
        }
    }

     //Function View Permohonan
    public function permohonan(){
        if(auth()->user()->role_id == 4 || auth()->user()->role_id == 3){
            $permohonan = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('permohonan_cuti.status', '=', 'Pending')
            ->orderBy('permohonan_cuti.created_at', 'DESC')
            ->get();
        }
        if(auth()->user()->role_id == 1){
            $permohonan = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('permohonan_cuti.status', '=', 'Pending')
            ->where('permohonan_cuti.user_id', '=', auth()->user()->id )
            ->orderBy('permohonan_cuti.created_at', 'DESC')
            ->get();
        }
        if(auth()->user()->role_id == 2){
            $permohonan = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('units.id', '=', auth()->user()->unit_id)
            ->where('permohonan_cuti.status', '=', 'Pending')
            ->orderBy('permohonan_cuti.created_at', 'DESC')
            ->get();
        }
        return view('permohonancuti.index', compact('permohonan'));
    }

   //Function View Acc Cuti
    public function permohonan_disetujui(){
        if(auth()->user()->role_id == 4 || auth()->user()->role_id == 3){
            $permohonan_disetujui = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('permohonan_cuti.status', '=', 'Disetujui')
            ->orderBy('permohonan_cuti.created_at', 'DESC')
            ->get();
        }
        if(auth()->user()->role_id == 1){
            $permohonan_disetujui = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('permohonan_cuti.status', '=', 'Disetujui')
            ->where('permohonan_cuti.user_id', '=', auth()->user()->id )
            ->orderBy('permohonan_cuti.created_at', 'DESC')
            ->get();
        }
        if(auth()->user()->role_id == 2){
            $permohonan_disetujui = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('units.id', '=', auth()->user()->unit_id)
            ->where('permohonan_cuti.status', '=', 'Disetujui')
            ->orderBy('permohonan_cuti.created_at', 'DESC')
            ->get();
        }
        return view('permohonancuti.disetujui', compact('permohonan_disetujui'));
    }

    //Function View Reject Cuti
    public function permohonan_ditolak(){
        if(auth()->user()->role_id == 4 || auth()->user()->role_id == 3){
            $permohonan_ditolak = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('permohonan_cuti.status', '=', 'Ditolak')
            ->orderBy('permohonan_cuti.created_at', 'DESC')
            ->get();
        }
        if(auth()->user()->role_id == 1){
            $permohonan_ditolak = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('permohonan_cuti.status', '=', 'Ditolak')
            ->where('permohonan_cuti.user_id', '=', auth()->user()->id )
            ->orderBy('permohonan_cuti.created_at', 'DESC')
            ->get();
        }
        if(auth()->user()->role_id == 2){
            $permohonan_ditolak = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
            ->leftJoin('units', 'users.unit_id', '=', 'units.id')
            ->where('units.id', '=', auth()->user()->unit_id)
            ->where('permohonan_cuti.status', '=', 'Ditolak')
            ->orderBy('permohonan_cuti.created_at', 'DESC')
            ->get();
        }
        return view('permohonancuti.ditolak', compact('permohonan_ditolak'));
    }

    //Acc Permohonan
    // public function setuju($id){
    //     $setuju = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
    //     ->select('permohonan_cuti.id', 'permohonan_cuti.user_id','permohonan_cuti.alasan_cuti', 
    //     'permohonan_cuti.tgl_mulai', 'permohonan_cuti.tgl_akhir', 'permohonan_cuti.status',
    //     'users.id', 'users.nip', 'users.name', 'users.jabatan')
    //     ->where('permohonan_cuti.id',$id)
    //     ->get();
    // }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\HakCuti;
use Illuminate\Http\Request;
use App\Models\PermohonanModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class KaryawanController extends Controller
{

    //Tambah Pegawai
    public function tambah(Request $request){
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'unit_id' => 'required',
            'hak_cuti' => 'required',
            
        ]);

        $data = [
            'name' => $request->name,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'unit_id' => $request->unit_id,
            'password' => Hash::make('sipeti123'),
            'role_id' => 1,
        ];
        $user = User::create($data);
        HakCuti::create([
            'user_id' => $user->id,
            'hak_cuti' => $request->hak_cuti,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('formpegawai')->with(['success' => 'Data Pegawai Berhasil Ditambah!']);
    }

    //Menampilkan Form Tambah Pegawai
    public function formtambahpegawai(){
        return view('pegawai.formtambahpegawai');
       }

    //Menampilkan Pegawai
    public function index()
    {
        $users = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        ->get();
        return view('pegawai.FormPegawai', compact('users'));
    }

    //Edit Pegawai By ID
    public function edit($id)
    {
        $decrypt_id = Crypt::decryptString($id);
        $users = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        ->where('hak_cuti.user_id', '=', $decrypt_id)
        ->get();
        return view('pegawai.formedit', compact('users'));
    }

    //Update Pegawai
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'role_id' => 'required',
            'jabatan' => 'required',
            'unit_id' => 'required',
        ]);

        $hak_cuti = $request->validate([
            'hak_cuti' => 'required',
        ]);

       User::whereId($request->id)->update($validated);
       HakCuti::whereId($request->id)->update($hak_cuti);
       return redirect()->route('formpegawai')->with(['success' => 'Data Pegawai Berhasil Diupdate!']);
    }

    //Delete Pegawai
    public function destroy (User $user, $id)
    {
        $hak_cuti = HakCuti::where('user_id', '=', $id);

        $hak_cuti->delete();

        $permohonan = PermohonanModel::where('user_id', '=', $id);

        $permohonan->delete();
        

        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->intended('formpegawai')->with(['success' => 'Data Karyawan Berhasil Dihapus!']);
    }
}

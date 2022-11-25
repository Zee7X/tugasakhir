<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

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
            'hak_cuti' => $request->hak_cuti,
            'password' => Hash::make('sipeti123'),
            'role_id' => 1,
        ];
        User::create($data);
        return redirect()->route('formpegawai')->with(['success' => 'Data Karyawan Berhasil Ditambah!']);
    }

    //View Form
    public function formtambahpegawai(){
        return view('pegawai.formtambahpegawai');
       }

    //Menampilkan Pegawai
    public function index()
    {
        $users = User::all();
        return view('pegawai.FormPegawai', compact('users'));
    }

    //Edit Pegawai By ID
    public function edit($id)
    {
        $users = User::findOrFail($id);
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
            'hak_cuti' => 'required',
        ]);

       User::whereId($request->id)->update($validated);
       return redirect()->route('formpegawai')->with(['success' => 'Data Karyawan Berhasil Diupdate!']);
    }

    //Delete Pegawai
    public function destroy (User $user, $id)
    {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->route('formpegawai')->with(['success' => 'Data Karyawan Berhasil Dihapus!']);
    }
}

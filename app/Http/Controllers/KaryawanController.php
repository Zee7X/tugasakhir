<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KaryawanController extends Controller
{
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
            'unit' => 'required',
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

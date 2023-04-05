<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\HakCuti;
use Illuminate\Http\Request;
use App\Models\PermohonanModel;
use App\Models\Role;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{

    //Tambah Pegawai
    public function tambah(Request $request){
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'nip' => 'required|unique:users,nip',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'unit_id' => 'required',
            'hak_cuti' => 'required',
            
        ]);
        $messages = [
            'nip'      => 'NIP Sudah Ada!',
        ];

        if ($validatedData->fails()) { 
            return back()->withInput()->withErrors($messages);
        }

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
        $unit = Unit::all();
        return view('pegawai.formtambahpegawai', compact('unit'));
       }

    //Menampilkan Pegawai
    public function index()
    {
        if(auth()->user()->role_id == 4 || auth()->user()->role_id == 3){
        $users = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        ->Join('units', 'users.unit_id', '=', 'units.id')
        ->select('units.name_unit','users.id','users.name','users.jabatan','users.nip','hak_cuti.hak_cuti')
        ->get();
        }
        if(auth()->user()->role_id == 2){
            $users = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        ->Join('units', 'users.unit_id', '=', 'units.id')
        ->where('units.id', '=', auth()->user()->unit_id)
        ->select('units.name_unit','users.id','users.name','users.jabatan','users.nip','hak_cuti.hak_cuti')
        ->get();
        }
        return view('pegawai.FormPegawai', compact('users'));
    }

    //Edit Pegawai By ID
    public function edit($id)
    {
        $unit = Unit::all();
        $role = Role::all();
        $decrypt_id = Crypt::decryptString($id);
        $users = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        ->Join('units', 'users.unit_id', '=', 'units.id')
        ->select('units.name_unit','users.id','users.unit_id','users.name','users.role_id','users.jenis_kelamin','users.jabatan','users.nip','hak_cuti.hak_cuti')
        ->where('hak_cuti.user_id', '=', $decrypt_id)
        ->get();
        return view('pegawai.formedit', compact('users','unit','role'));
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

        return redirect()->back()->with(['success' => 'Data Pegawai Berhasil Dihapus!']);
    }
}

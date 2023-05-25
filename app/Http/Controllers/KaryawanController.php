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
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{

    //Tambah Pegawai
    public function tambah(Request $request){
        $validated = Validator::make($request->all(),[
            'nip' => 'required|unique:users,nip',
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'unit_id' => 'required',
            'hak_cuti' => 'required',
        ],
        [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'name.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'unit_id.required' => 'Unit wajib diisi.',
            'hak_cuti.required' => 'Hak Cuti wajib diisi.',
        ]
    );
        
        if ($validated->fails()) {
            return redirect()->back()->with(['error' => $validated->messages()->all()[0]])->withInput();
        }

        $data = [
            'name' => $request->name,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'unit_id' => $request->unit_id,
            'password' => Hash::make('Sicute123'),
            'role_id' => 1,
        ];
        $user = User::create($data);
        HakCuti::create([
            'user_id' => $user->id,
            'hak_cuti' => $request->hak_cuti,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('pegawai')->with(['success' => 'Data Pegawai Berhasil Ditambah!']);
    }

    //Menampilkan Form Tambah Pegawai
    public function formtambahpegawai(){
        $unit = Unit::all();
        return view('pegawai.formtambahpegawai', compact('unit'));
       }

    //Menampilkan Pegawai
    public function index()
    {
        if(auth()->user()->role_id == 4 || auth()->user()->role_id == 3 || auth()->user()->role_id == 5){
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

    //View Edit Pegawai By ID(Admin)
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


    //View Edit Profile (User)
    public function viewprofile(){
        $unit = Unit::all();
        $users = User::join('units', 'users.unit_id', '=', 'units.id')
            ->select('units.name_unit','users.id','users.unit_id','users.name','users.jenis_kelamin','users.jabatan','users.nip', 'users.email')
            ->where('users.id', '=', auth()->user()->id)
            ->get();
        return view('pegawai.editprofile', compact('users', 'unit'));
    }

    //Update Profile(User)
    public function editprofile(Request $request, $id)
    {
        $validated = Validator::make($request->all(),[
            'nip' => 'required|unique:users,nip,'.$id,
            'email'=>'required|unique:users,nip,'.$id,
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'unit_id' => 'required',
            'password' => 'nullable',
            'new_password' => 'nullable',
        ],
        [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'name.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'unit_id.required' => 'Unit wajib diisi.',
            'new_password.min' => 'Password minimal 8 karakter.',
        ]
    );
        
        if ($validated->fails()) {
            return redirect()->back()->with(['error' => $validated->messages()->all()[0]])->withInput();
        }

        $user = User::find($id);

        $user->nip = $request['nip'];
        $user->email = $request['email'];
        $user->name = $request['name'];
        $user->jenis_kelamin = $request['jenis_kelamin'];
        $user->jabatan = $request['jabatan'];
        $user->unit_id = $request['unit_id'];

        if ($request->password != null) {
            // Check if old password is correct
            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()->with(['error' =>'Password lama salah'])->withInput();
            }
    
            // Update password
            $user->password = Hash::make($request->new_password);
        }
        $user->save();
        return redirect()->route('dashboard')->with(['success' => 'Profile Berhasil Diupdate!']);
    }

    //Update Pegawai
    public function update(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'nip' => 'required|unique:users,nip,'.$request->id,
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'unit_id' => 'required',
            'role_id' => 'required',
            'hak_cuti' => 'required|numeric|min:0',
            'password' => 'nullable|min:8',
        ],
        [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'name.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'hak_cuti.required' => 'Hak Cuti wajib diisi.',
            'unit_id.required' => 'Unit wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]
    );

        if ($validated->fails()) {
            return redirect()->back()->with(['error' => $validated->messages()->all()[0]])->withInput();
        }

        $hak_cuti = $request->validate([
            'hak_cuti' => 'required',
        ]);

        $user = User::findorFail($request->id);
        $user->nip = $request['nip'];
        $user->name = $request['name'];
        $user->jenis_kelamin = $request['jenis_kelamin'];
        $user->jabatan = $request['jabatan'];
        $user->role_id = $request['role_id'];
        $user->unit_id = $request['unit_id'];
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
    //    User::whereId($request->id)->update($validated);
       HakCuti::where('user_id', '=', $request->id)->update($hak_cuti);
       return redirect()->route('pegawai')->with(['success' => 'Data Pegawai Berhasil Diupdate!']);
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

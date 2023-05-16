<?php

namespace App\Http\Controllers;


use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class UnitController extends Controller
{
        //Menampilkan Unit
        public function view_unit()
        {
            $units = Unit::all();
            $totalPegawaiPerUnit = [];
            foreach ($units as $unit) {
                $users = User::where('unit_id', $unit->id)->get();
                $totalPegawai = count($users);
                $totalPegawaiPerUnit[$unit->name_unit] = $totalPegawai;
            }
            return view('unit.unit', compact('units', 'totalPegawaiPerUnit'));
        }

        //Tambah Unit
        public function tambahunit (Request $request)
        {
            $validatedData = Validator::make($request->all(),[
                'name_unit' => 'required|unique:units,name_unit',
            ]);
            if ($validatedData->fails()) { 
                return redirect()->back()->with(['error' => 'Unit Sudah Ada!']);
            }
            $data = [
                'name_unit' => $request->name_unit,
            ];
            Unit::create($data);
            return redirect()->route('unit')->with(['success' => 'Data Unit Berhasil Ditambah!']);
        }

        //Delete Unit
        public function hapusunit(Unit $units, $id)
        {
            try {
                $unit = Unit::findOrFail($id);
                $isUsed = DB::table('users')->where('unit_id', $units->id)->exists();
                if ($isUsed) {
                    return redirect()->back()->with('error', 'Unit Tidak Dapat Dihapus, Masih Terdapat Pegawai!');
                }
                $unit->delete();
                return redirect()->back()->with('success', 'Data Unit Berhasil Dihapus!');
            } catch (QueryException $ex) {
                $errorCode = $ex->errorInfo[1];
                if ($errorCode == 1451) {
                    return redirect()->back()->with('error', 'Unit Tidak Dapat Dihapus, Masih Terdapat Pegawai!');
                }
                return redirect()->back()->with('error', 'Unit Tidak Dapat Dihapus, Masih Terdapat Pegawai!');
            }
        }

        //Update Unit
        public function editunit(Request $request, $id)
        {
            $request->validate([
                'name_unit' => 'required|max:255',
            ]);
            $unit = Unit::findOrFail($id);
            if ($request->name_unit !== $unit->name_unit) {
                $isDuplicate = Unit::where('name_unit', $request->name_unit)->exists();
                if ($isDuplicate) {
                    return redirect()->back()->with('error', 'Nama Unit sudah digunakan, silakan gunakan nama lain.');
                }
            }
            $unit->name_unit = $request->name_unit;
            $unit->save();
        
            return redirect()->back()->with('success', 'Data Unit Berhasil Diubah!');
        }
}
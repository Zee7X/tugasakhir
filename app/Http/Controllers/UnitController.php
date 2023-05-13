<?php

namespace App\Http\Controllers;


use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
        //Menampilkan Unit
        public function view_unit()
        {
            $unit = Unit::all();
            return view('unit.unit', compact('unit'));
        }

        //Tambah Unit
        public function tambahunit (Request $request)
        {
            $validatedData = Validator::make($request->all(),[
                'name_unit' => 'required|unique:units,name_unit',
            ]);
            $messages = [
                'name_unit' => 'Unit Sudah Ada!',
            ];
            if ($validatedData->fails()) { 
                return redirect()->route('unit')->withErrors($messages);
            }
            $data = [
                'name_unit' => $request->name_unit,
            ];
            Unit::create($data);
            return redirect()->route('unit')->with(['success' => 'Data Unit Berhasil Ditambah!']);
        }

        //Delete Unit
        public function hapusunit (Request $request, $id){
            if($request->isJson()){
                $unit = Unit::where('id',$id);
                $user = User::where('unit_id',$id);
                if($user){
                    return response()->json([
                        'success' => false,
                        'message' => 'Terdapat pegawai didalam unit ini.'
                    ]);
                    // return redirect()->route('unit')->with(['error' => 'Terdapat pegawai didalam unit ini.']);
                }else{
                    $unit->delete();
                    return response()->json([
                        'success' => false,
                        'message' => 'Berhasil hapus unit.'
                    ]);
                    // return redirect()->route('unit')->with(['success' => 'Data Unit Berhasil Dihapus!']);
            }   
        }else{
            return(404);
        }       
    }
}
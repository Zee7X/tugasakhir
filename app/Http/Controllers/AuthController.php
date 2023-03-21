<?php

namespace App\Http\Controllers;

use Hash;
use datatables;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PermohonanModel;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthController extends Controller
{

    //Login Form
    public function login_view(){
        return view('Auth.login');
    }

    public function dashboard(Request $request){
        $sisacuti = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        ->where('hak_cuti.user_id', '=', auth()->user()->id)
        ->get();

        
        // $dashboard = PermohonanModel::orderBy('id', 'desc')->get();
        $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
        ->leftJoin('units', 'users.unit_id', '=', 'units.id')
        ->orderBy('permohonan_cuti.created_at', 'DESC')
        // ->limit(5)
        ->get();
        $dashboard2 = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
        ->rightJoin('units', 'users.unit_id', '=', 'units.id')
        ->orderBy('permohonan_cuti.created_at', 'DESC')
        ->where('users.role_id', '=', auth()->user()->role_id)
        ->where('users.id', '=', auth()->id())
        ->get();
        $dashboard3 = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
        ->rightJoin('units', 'users.unit_id', '=', 'units.id')
        ->orderBy('permohonan_cuti.created_at', 'DESC')
        ->where('users.unit_id', '=', auth()->user()->id)
        ->get();
        $disetujui = PermohonanModel::where('status', '=', 'Disetujui')
        ->count();
        $ditolak = PermohonanModel::where('status', '=', 'Ditolak')
        ->count();
        $pending = PermohonanModel::where('status', '=', 'Pending')
        ->count();
        $disetujui2 =  PermohonanModel::where('status', '=', 'Disetujui')
        ->where('user_id', '=', auth()->user()->id)
        ->count();
        $disetujui3 =  User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
        ->where('status', '=', 'Disetujui')
        ->where('users.unit_id', '=', auth()->user()->id)
        ->count();
        $ditolak2 =  User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
        ->where('status', '=', 'Ditolak')
        ->where('users.role_id', '=', auth()->user()->id)
        ->count();
        $ditolak3 =  User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
        ->where('status', '=', 'Ditolak')
        ->where('users.unit_id', '=', auth()->user()->id)
        ->count();
        // ->orderBy('users.created_at', 'DESC')
        // ->select(['users.name', 'permohonan_cuti.alasan_cuti', 'users.created_at']);
        // ->whereDate('users.created_at', Carbon::today());
        // dd($disetujui3);
        
        return view('Dashboard.Dashboard', compact('dashboard','dashboard2','dashboard3','sisacuti', 'disetujui', 'ditolak', 'pending', 'disetujui2','disetujui3','ditolak2','ditolak3',));
    }

    //Login Function
    public function login(Request $request){
        $check = 0;
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        $credential = $request->except(['_token']);

        $users = User::select('nip')->get();

        foreach ($users as $user)
        {
            if($user->nip == $request->nip)
            {
                $check = 1;
            }
        }
        if($check == 1){
            if (auth()->attempt($credential)){
                return redirect()->route('dashboard');
            }else{
                return redirect()->back()->withErrors(['msg' => 'NIP/Password Salah']);
            }
        }
        else{
            return redirect()->back()->withErrors(['msg' => 'NIP/Password Salah']);
        }
    }

    //Logout Function
    public function logout(Request $request){
        Session::flush();
        Auth::logout();
        return Redirect()->route('login');
    }
}

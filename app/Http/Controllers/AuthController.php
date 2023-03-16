<?php

namespace App\Http\Controllers;

use Hash;
use datatables;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Controller;
use App\Models\PermohonanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except('logout');
    // }

    public function login_view(){
        return view('Auth.login');
    }

    public function dashboard(Request $request){
        $sisacuti = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        ->where('hak_cuti.user_id', '=', auth()->user()->id)
        ->get();

        
        // $dashboard = PermohonanModel::orderBy('id', 'desc')->get();
        $dashboard = User::join('permohonan_cuti', 'users.id', '=', 'permohonan_cuti.user_id')
        ->orderBy('permohonan_cuti.created_at', 'DESC')
        // ->limit(5)
        ->get();
        // ->orderBy('users.created_at', 'DESC')
        // ->select(['users.name', 'permohonan_cuti.alasan_cuti', 'users.created_at']);
        // ->whereDate('users.created_at', Carbon::today());
        // dd($dashboard);
        
        return view('Dashboard.Dashboard', ['dashboard'=>$dashboard], ['sisacuti'=>$sisacuti],);
    }

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
    public function logout(Request $request){

        Session::flush();
        Auth::logout();
        return Redirect()->route('login');
    }
}

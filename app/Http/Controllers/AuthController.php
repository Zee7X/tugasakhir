<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;


class AuthController extends Controller
{

    //Login Form
    public function login_view(){
        return view('Auth.login');
    }

    //Dashboard
    public function dashboard(){
        $sisacuti = User::join('hak_cuti', 'users.id', '=', 'hak_cuti.user_id')
        ->where('hak_cuti.user_id', '=', auth()->user()->id)
        ->get();
        return view('Dashboard.Dashboard', compact('sisacuti'));
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

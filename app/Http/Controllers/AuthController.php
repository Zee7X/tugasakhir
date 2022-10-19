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
    // public function __construct()
    // {
    //     $this->middleware('auth')->except('logout');
    // }

    public function login_view(){
        return view('Auth.login');
    }

    public function dashboard(){
        return view('Dashboard.Dashboard');
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

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

    //Reset Password Form
    public function reset_password(){
        return view('Auth.reset_password');
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

                return redirect()->route('dashboard')->with(['success' => 'Selamat datang di dashboard']);
            }else{
                return redirect()->route('login')->with(['error' => 'NIP atau Password Salah']);
            }
        }
        else{
            return redirect()->route('login')->with(['error' => 'NIP atau Password Invalid']);
        }
    }

    //Logout Function
    public function logout(Request $request){
        Session::flush();
        Auth::logout();
        return Redirect()->route('login');
    }
}

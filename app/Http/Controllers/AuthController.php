<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authentication(Request $request)
    {
        $auth = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($auth)) {
            if (auth()->user()->status == 1) {
                $request->session()->regenerate();
                Session::flash('success', 'Login berhasil');
                return redirect()->route('index');
            } else {
                Session::flash('error', 'Status anda inactive, silahkan hubungi admin');
                return redirect()->back();
            }
        }
        Session::flash('error', 'Login gagal');
        return redirect()->back();
    }
    public function register()
    {
        return view('pages.auth.register');
    }

    public function prosesRegister(Request $request)
    {
        $register = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        $register['role_id'] = 2;
        $register['password'] = bcrypt($register['password']);
        User::create($register);
        Session::flash('success', 'Register Success');
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'Logout berhasil');
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{

    // tampilkan form login
    public function formlogin()
    {
        return view('navbar.formlogin');
    }


    // proses login
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // cek role
            if (Auth::user()->role == 'admin') {

                return redirect('/admin/dashboard');

            } else {

                return redirect('/user/dashboard');

            }

        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);

    }


    // logout
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');

    }

}

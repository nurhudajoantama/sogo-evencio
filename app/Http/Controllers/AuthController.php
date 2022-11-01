<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->user()->is_admin) {
                return redirect()->route('dashboard.index');
            }
            return redirect()->route('index');
        }
        return redirect()->back()->with('error', 'Email or password is incorrect');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|alpha_dash|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        User::create($request->all());
        return redirect()->route('login')->with('success', 'User created successfully');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('index');
    }
}

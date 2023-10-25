<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect()->back()->with(['error'=>'Username atau password salah']);
    }

    public function authenticated(Request $request, $user)
        {
            if ($user->hasRole('admin')) {
                return redirect()->route('index');
            }

            return redirect()->route('index');
        }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}

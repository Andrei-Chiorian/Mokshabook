<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function index() 
    {
        return view('auth.login');
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'email' => 'required|email' ,
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email','password'), $request->remember)) {
            return back()->with('mensaje','Email o Contraseña incorrecto');
        }

        return redirect()->route('home', auth()->user()->username);
    }
}

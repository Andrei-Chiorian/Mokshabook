<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    //Retornar la pagina principal
   public function index() 
   {
        return view('auth.register',);
    }

    //Recojer, validar y almacenar datos del formulario
    public function store(Request $request)
    {
        //Modificar request para quitar los espacios
        //$request->request->add(['username'=>Str::slug($request->username)]);

        //Validacion
        $this->validate($request, [
            'name' => 'nullable|max:30' ,
            'username' => 'required|unique:users|min:3|max:20' ,
            'presentacion' => 'nullable|max:150' ,
            'email' => 'required|unique:users|email|max:60' ,
            'password' => ['required','unique:users','confirmed',Password::min(8)->letters()->numbers()]             
        ]);

        //Creacion de registros
        User::create([
            'name' => $request->name,
            'username' =>$request->username,
            'presentacion' =>$request->presentacion,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Autenticar al usuario
        // auth()->attempt([
        //     'email'=> $request->email,
        //     'password'=> $request->password
        // ]);

        //Autenticar solo con email y password
        auth()->attempt($request->only('email','password'));

        //Redireccion al muro
        return redirect()->route('posts.index',auth()->user()->username);

    }
}

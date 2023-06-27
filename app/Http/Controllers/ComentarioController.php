<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request ,User $user, Post $post) 
    {
        //dd($request->comentario);
        //Validacion
        $this->validate($request, [
            'comentario'=>'required|max:255',    
            
        ]);

        //Almacenar
        Comentario::create([
            'comentario'=>  $request->comentario,
            'user_id'=>  auth()->user()->id,
            'post_id'=>  $post->id,            
            
        ]);

        return back()->with('mensaje','Comentario publicado');

        
        // $request->user()->posts()->create([
        //     'comentario'=>  $request->titulo,
        //     'post_id'=>  $request->descripcion,            
        //     'user_id'=>  auth()->user()->id

        // ]);

        //Imprimir mensaje
    }
}
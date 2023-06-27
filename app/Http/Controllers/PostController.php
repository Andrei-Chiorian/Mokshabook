<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }
    //Retornar el muro
    public function index(User $user) 
    {

        $posts= Post::where('user_id',$user->id)->latest()->paginate(20);

        return view('dashboard', [
            'posts' => $posts,
            'user' => $user
        ]);
        
    }

    //Retornar vista para crear publicacion
    public function create() 
    {
        return view('posts.create');
        
    }

    //Validar y guardar de base datos
    public function store(Request $request) 
    {
        $this->validate($request, [                       
            'imagen'=>'required',
        ]);
    // GUARDAR DATOS EN LA BBDD
        // Post::create([        //     
        //     'descripcion'=>  $request->descripcion,
        //     'imagen'=>  $request->imagen,
        //     'user_id'=>  auth()->user()->id
        // ]);

    // OTRA FORMA DE GUARDAR EN LA BBDD
        // $post = new Post;        
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

    // OTRA FORMA DE GUARDAR EN LA BBDD
        $request->user()->posts()->create([            
            'descripcion'=>  $request->descripcion,
            'imagen'=>  $request->imagen,
            'user_id'=>  auth()->user()->id

        ]);

        return redirect()->route('posts.index', auth()->user()->username);
               
    }

    public function show(User $user, Post $post)
    {   
        $date = Carbon::now();
        $date = $post->created_at;
        $date = Carbon::parse('2021-03-25');
        $date = $date->format('Y-m-d');
        $comen = $post->comentarios->sortByDesc('created_at');
        $count = 0;
          
        return view('posts.show',['post'=>$post,'user'=>$user, 'date'=>$date, 'comen'=>$comen, 'count'=> $count]);
    }

    public function destroy(Post $post)
    {  
        $this->authorize('delete', $post);
        $post->delete();

        $imagen_path = public_path('uploads/' . $post->imagen);
        if (File::exists($imagen_path)) {
            unlink($imagen_path);            
        }
        
        return redirect()->route('posts.index', auth()->user()->username);
    }

    

}

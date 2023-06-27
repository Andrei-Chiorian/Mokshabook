<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Expr\Print_;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Contracts\Service\Attribute\Required;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profiles.profile');
    }

    public function store(Request $request)
    {
        //$request->request->add(['username'=>Str::slug($request->username)]);
        
        $this->validate($request,[
            'name' => 'nullable|max:30' ,
            'username'=>[
                'required', 
                'unique:users,username,'.auth()->user()->id, 
                'min:3', 
                'max:20', 
                'not_in:twitter,editar-perfil,index,Login,register,login,logout,posts,imagenes,comentario,likes'
            ],
            'email' => 'email|max:60|unique:users,email,'.auth()->user()->id ,
            'presentacion' => 'nullable|max:150' , 
        ]);

        

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nomImagen = Str::uuid() . "." . $imagen->extension();
            
            $imgServ = Image::make($imagen);
            $imgServ->fit(1000,1000,);
            $imgServ->orientate();


            $imgPath = public_path('profiles') . '/' . $nomImagen;
            $imgServ->save($imgPath);            
        }
               

        $usuario = User::find(auth()->user()->id);
        $usuario->name = $request->name;
        $usuario->username = $request->username;
        $usuario->presentacion = $request->presentacion;
        $usuario->email = $request->email;
        $usuario->imagen = $nomImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        //Borrar la imagen almacenada que no este en uso        
        $usersImage = DB::select('SELECT imagen FROM users');       
        $arrFiles = scandir(public_path('profiles'),1);
     
        foreach($arrFiles as $arrFile){
            $match = 0;

            foreach($usersImage as $userImage){                
                if ($arrFile === $userImage->imagen) {                               
                    $match++;                                     
                }                         
            }
           
           if ($arrFile != '.' && $arrFile != '..') {                
                if ($match == 0) {                   
                    $imagen_path = public_path('profiles/' . $arrFile);
                    if (File::exists($imagen_path)) {                        
                        unlink($imagen_path);            
                    }                
                }
           }            
        }         
        
        return redirect()->route('posts.index',$usuario->username);
    }
}

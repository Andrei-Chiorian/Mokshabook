<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        $nomImagen = Str::uuid() . "." . $imagen->extension();
        
        $imgServ = Image::make($imagen);
        $imgServ->fit(1000, 1000, );
        $imgServ->orientate();

        $imgPath = public_path('uploads') . '/' . $nomImagen;
        $imgServ->save($imgPath);


        return response()->json(['imagen' => $nomImagen]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //ALMACENAR UNA RELACION DE SEGUIMIENTO
    public function store(User $user)
    {
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    //ELIMINAR UNA RELACION DE SEGUIMIENTO
    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}

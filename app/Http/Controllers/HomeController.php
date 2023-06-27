<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {   
        if (auth()->user()) {
            // $aunId = auth()
            $ids = auth()->user()->following->pluck('id')->toArray();
            $posts = Post::whereIn('user_id', $ids)->latest()->paginate(12);
            $following = auth()->user()->following;
            
            
              return view('home',['posts' => $posts,'ids' => $ids, 'following'=>$following]);
             //dd($following[0]->id);
        }

        return redirect('login');
    }
   
}

<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        Like::create([            
            'user_id'=>  auth()->user()->id,
            'post_id'=>  $post->id,    
            
        ]);
        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}

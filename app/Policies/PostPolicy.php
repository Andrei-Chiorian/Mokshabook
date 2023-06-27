<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

      
  
    public function delete(User $user, Post $post):bool
    {
        return $user->id === $post->user_id;
    }

   
}

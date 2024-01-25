<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);
        // return redirect()->route('posts.show', ['user'=> $user, 'post' => $post])->with('message', 'Comentario exitoso');
        return back();
        
    }
}

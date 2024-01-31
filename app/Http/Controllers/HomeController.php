<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function __invoke()
    {
        $followings = auth()->user()->followings->pluck('follower_id')->toArray();
        $followed_post = Post::whereIn('user_id', $followings)->latest()->paginate(10);

        return view("home", [
            'posts' => $followed_post 
        ]);
    }
}

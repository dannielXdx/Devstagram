<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(User $user, Request $request)
    {
        $this->validate($request, [

        ]);
        
        Follower::create([
            'user_id'=> auth()->user()->id,
            'follower_id' => $user->id,
        ]);

        return back();
    }

    public function destroy(User $user, Request $request)
    {
        auth()->user()->followings()->where('user_id', auth()->user()->id)->where('follower_id', $user->id)->delete();

        return back();
    }
}

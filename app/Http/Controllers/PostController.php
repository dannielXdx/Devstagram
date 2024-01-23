<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function index(User $user)
    {
        
        // $posts = Post::where('user_id', $user->id)->get();
        $posts = Post::where('user_id', $user->id)->paginate(10);
        // $posts = Post::where('user_id', $user->id)->simplePaginate(5);


        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=> 'required|min:3|max:100',
            'description' => 'required',
            'image' => 'required'
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        // Forma 2 de crear registros:
        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->image = $request->image;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //Forma 3 de crear registros:
        // $request->user()->posts()->create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'user_id' => auth()->user()->id
        // ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post'=> $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar imagen del public
        $imagen_path = public_path('uploads/' . $post->image );

        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
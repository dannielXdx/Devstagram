<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function index(){



        return view('profile.profile');
    }

    public function store(Request $request){
        $request->request->add(['username' => Str::slug($request->username)]);
        
        $this->validate($request, [
            'name' => 'required|min:5|max:50',
            // unique modo 1
            'username' => ['required', 'min:5', 'max:12', Rule::unique(
                'users')->ignore($request->user()->id), 'not_in:editar-perfil'],
            // unique modo 2
            'email' => ['required', 'max:50', 'email', 'unique:users,email,'.auth()->user()->id],
        ]);
        
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if($request->image){
            $file = $request->file('image');

            if($file ){
                // create image manager with desired driver
                $manager = new ImageManager(new Driver());
                $nombreImagen = Str::uuid() . "." . $file->extension();
                $imageServer = $manager->read($file);
                $imageServer->cover(1000, 1000);
            }
    
            $imagePath = public_path('profiles') . "/" . $nombreImagen;
            $imageServer->save($imagePath);
            $user->image = $nombreImagen;
        }
        $user->save();

        return redirect()->route("posts.index", $user->username);
    }
}

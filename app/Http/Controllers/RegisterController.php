<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // Modificar el request en casos extremos :v
        // Esto es para que se haga slug antes de la validacion de unique
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validation
        $this->validate($request, [
            'name' => 'required|min:5|max:50',
            // es válido también pasarlo como arreglo ['required', 'min:5'],
            'username' => 'required|min:5|max:12|unique:users',
            'email' => 'required|max:50|unique:users|email',
            'password' => 'required|confirmed|min:6|max:15',
            'password_confirmation' => 'required',
        ]);

        //Equivalente a INSERT INTO USERS
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            // para el hash en el campo es (no fue necesario en este caso):
            // 'password' => Hash::make($request->password),
        ]);

        // Autenticar un usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);
        
        //Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        //Redireccionar
        return redirect()->route('posts.index', auth()->user()->username);
    }
}

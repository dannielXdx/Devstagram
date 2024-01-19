<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validación
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($request->only('email', 'password'),$request->remember)){
            // Back te lleva a la página en la que estaba antes del POST
            // with agrega a la sesión anterior un campo y valor.
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        return redirect()->route('posts.index');
    }
}

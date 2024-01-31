@extends('layouts.app')

@section('title')
    editar perfil
@endsection

@section('content')
    <div class="md:flex md:justify-center" >
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold" />
                    Imagen de perfil
                    </label>
                    <input id="image" name="image" type="file" accept=".jpg, .jpeg, .png"
                        class="border p-3 w-full rounded-lg @error('image') border-red-500 @enderror"
                        value="" />
                </div>
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold" />
                    nombre
                    </label>
                    <input id="name" name="name" type="text" placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ auth()->user()->name }}" />
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold" />
                    nombre de usuario
                    </label>
                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"/>
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold" />
                    correo electrónico
                    </label>
                    <input id="email" name="email" type="text" placeholder="Tu correo de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}" />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <input type="submit" value="guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colours cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
        </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    Regístrate en DevStagram
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2">
            <p>Imagen aquí</p>
        </div>
        <div class="md:w-1/2 bg-white p-6 rou shadow-xl">
            <form>
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold"/>
                        nombre
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold"/>
                        nombre de usuario
                    </label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"/>
                        correo electrónico
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="text"
                        placeholder="Tu correo de registro"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold"/>
                        contraseña
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Tu contraseña"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold"/>
                repetir contraseña
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                placeholder="Tu contraseña"
                class="border p-3 w-full rounded-lg"
            />
            <input
                type="submit"
                value="crear cuenta"
                class="bg-sky-600 hover:bg-sky-700 transition-colours cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            />
        </div>
            </form>
        </div>
    </div>
@endsection
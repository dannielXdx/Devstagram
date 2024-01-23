@extends('layouts.app')

@section('title')
    perfil
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center ">
            <div class="sm:w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="imagen usuario"></p>
            </div>
        </div>
        <div class="8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
            <p class='text-gray-700 text-2xl'>
                {{ $user->username }}
            </p>
            <p class='text-gray-800 text-sm mb-3 font-bold mt-5'>
                0
                <span class="font-normal">
                    Seguidores
                </span>
            </p>
            <p class='text-gray-800 text-sm mb-3 font-bold'>
                0
                <span class="font-normal">
                    Siguiendo
                </span>
            </p>
            <p class='text-gray-800 text-sm mb-3 font-bold'>
                0
                <span class="font-normal">
                    Posts
                </span>
            </p>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-3xl text-center font-black my-10 uppercase">
            Publicaciones
        </h2>
        @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
            {{-- Sin regresarle $posts desde el controlador también hay un camino desde user, pero sólo se puede paginar desde la colección del controlador--}}
                {{-- @foreach ($user->posts as $post) --}}
            <div>
                <a href="">
                    <img src="{{asset('uploads') . "/" . $post->image}}" alt="Imagen del post {{$post->title}}">
                </a> 
            </div>
            @endforeach
        </div>
        <div class="">
            {{$posts->links('pagination::tailwind')}}
        </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">
                No hay nada aquí</p>
        @endif
    </section>
    @endsection

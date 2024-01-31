@extends('layouts.app')

@section('title')
{{ $post->title }}
@endsection


@section('content')
<div class="container mx-auto md:flex">
    <div class="md:w-1/2">
        <img src={{ asset("uploads") . "/" . $post->image }} alt="Imagen del post {{ $post->title }}">
        <livewire:like-post :post="$post" />
        <div>
            <a class="font-bold" href="{{ route('posts.index', $post->user)}}">
                {{$post->user->username }}
            </a>
            <p class="mt-1">
                {{ $post->description }}
            </p>
            <p class="text-sm, text-gray-500">
                {{-- diffForHumans es nativo en laravel a través de la librería Carbon --}}
                {{ $post->created_at->diffForHumans() }}
            </p>
        </div>
        @auth
            @if($post->user_id == auth()->user()->id)
            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                {{-- Se llama método spoofing y se utiliza para enviar otros métodos a parte de get y post a traves del navegador --}}
                @method('DELETE')
                @csrf
                <input 
                type="submit"
                value="Eliminar publicación"
                class="bg-red-500 hover:bg-red-600 p-2 rounded text-white
                font-bold mt-4 cursor-pointer"
                />
                
            </form>
            @endif     
        @endauth
    </div>
    <div class="md:w-1/2 p-5">
        <div class=" shadow bg-white p-5 mb-5">
            <p class="text-xl font-bold text-center mb-4">Comentarios</p>
            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-6">
                @if($post->comments->count())
                    @foreach ( $post->comments as $comment )
                        <div class="p-5 border-gray-300 border-b ">
                            <div class="flex items-center ">
                                <img class="size-10 rounded-full mr-2" src="{{ $comment->user->image ? asset('profiles') . '/' . $comment->user->image : asset('img/usuario.svg') }}" alt="profile picture">
                                <a href={{ route('posts.index', $comment->user) }} class="font-bold">
                                    {{ $comment->user->username }}
                                </a>
                            </div>
                            <div class="mt-2">
                                <p>
                                    {{ $comment->comment }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    @else
                <p class="p-10 text-center">
                    No hay comentarios
                </p>
                @endif
            </div>
            @auth
            @if(session('message'))
                <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                    {{ session('message') }}
                </div>
                
            @endif
            <form action="{{ route('comments.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold" />
                        agrega un comentario
                    </label>
                    <textarea id="comment" name="comment" placeholder="Agrega un comentario"
                        class="border p-3 w-full rounded-lg @error('comment') border-red-500 @enderror">
                </textarea>
                    @error('comment')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <input type="submit" value="comentar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colours cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
            @endauth
        </div>
    </div>
</div>

@endsection
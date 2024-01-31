<div>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post)
        {{-- Sin regresarle $posts desde el controlador también hay un camino desde user, pero sólo se puede paginar desde la colección del controlador--}}
            {{-- @foreach ($user->posts as $post) --}}
        <div>
            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                <img class="rounded-2xl" src="{{asset('uploads') . "/" . $post->image}}" alt="Imagen del post {{$post->title}}">
            </a> 
        </div>
        @endforeach
    </div>
    <div class="mt-5">
        {{$posts->links('pagination::tailwind')}}
    </div>
    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">
            No hay nada que mostrar, quizá debas seguir a más personas. </p>
    @endif
</div>
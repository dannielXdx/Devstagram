<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLike;
    public $likes;

    // Esto es un constructor de livewire
    public function mount($post)
    {
        $this->isLike = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if( !$this->post->checkLike(auth()->user() ))
        {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLike = true;
            $this->likes++;
        }
        else
        {
            auth()->user()->likes()->where('post_id', $this->post->id)->delete();
            $this->isLike = false;
            $this->likes--;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}

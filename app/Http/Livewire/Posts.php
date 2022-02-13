<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;


class Posts extends Component
{
    public $postID;


    public function archivePost($id)
    {
        $post = Post::findOrFail($id);
        $post->archived = 1;
        $post->update();
    }

    public function render()
    {
        $posts = Post::with([ 'user', 'postcategory', 'photos'])
            ->where('archived', 0)
            ->latest()
            ->paginate(10);

        $timeNow = Carbon::now()->toDateString();
        return view('livewire.posts', compact('posts', 'timeNow'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Livewire\Component;

class UnarchivePosts extends Component
{

    public function unArchivePost($id)
    {
        $post = Post::findOrFail($id);
        $post->archived = 0;
        $post->update();
    }

    public function render()
    {
        $posts = Post::with(['user', 'postcategory'])
            ->where('archived', 1)
            ->latest()
            ->paginate(10);

        $timeNow = Carbon::now()->toDateString();

        return view('livewire.unarchive-posts', compact('posts', 'timeNow'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostCategory;
use Livewire\Component;

class UnarchivePostCategories extends Component
{
    public function unArchivePostCategory($id)
    {
        $category = PostCategory::findOrFail($id);
        $category->archived = 0;
        $category->update();
    }


    public function render()
    {
        $postcategories = PostCategory::where('archived', 1)
            ->paginate(10);
        return view('livewire.unarchive-post-categories', compact('postcategories'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\PostCategory;
use Livewire\Component;

class PostCategoriesTable extends Component
{
    public $postcategory;
    public $name;

    public function archivePostCategory($id)
    {
        $postcategory = PostCategory::findOrFail($id);
        $postcategory->archived = 1;
        $postcategory->update();
    }


    protected $listeners = [
        'updateCategoriesTable',
    ];

    public function updateCategoriesTable($name)
    {
        $this->postcategory = $name;
    }

    public function removeCategory($id)
    {
        $postcategory = PostCategory::findOrFail($id);
        $postcategory->delete();
    }

    protected $rules = [
        'name' => 'required',
    ];

    public function submitFormCategory($id)
    {

        $this->validate();

        $data = [
            'name' => $this->name,
        ];


        $postcategory = PostCategory::findOrFail($id);
        $postcategory->name = $this->name;

        $postcategory->update();

        $this->reset([
            'name',
        ]);

        $this->dispatchBrowserEvent('closeModal');
    }


    public function render()
    {
        $postcategories = PostCategory::where('archived', 0)
            ->latest()
            ->paginate(20);

        $postcategory = $this->postcategory;
        return view('livewire.post-categories-table', compact('postcategories', 'postcategory'));
    }
}

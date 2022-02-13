<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostCategories extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required',
    ];


    public function submit()
    {
        $this->validate();
        $data = [ 'name' => $this->name ];

        \App\Models\PostCategory::create([
            'name' => $this->name,
        ]);

        $this->emit('updateCategoriesTable', $this->name);

        $this->reset([
            'name',
        ]);

    }

    public function render()
    {
        return view('livewire.post-categories');
    }
}

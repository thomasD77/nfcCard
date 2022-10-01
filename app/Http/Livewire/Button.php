<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Button extends Component
{

    public function createButton()
    {
        $button = new \App\Models\Button();
        $button->member_id = Auth::user()->member->id;
        $button->save();
    }

    public function deleteButton($id)
    {
       $button = \App\Models\Button::findOrFail($id);
       $button->delete();
    }

    public function render()
    {
        $buttons = \App\Models\Button::where('member_id', Auth::user()->member->id)->get();
        return view('livewire.button', compact('buttons'));
    }
}

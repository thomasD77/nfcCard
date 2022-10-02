<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;


class Button extends Component
{
    public Member $member;

    public function mount($member)
    {
        $this->member = $member;
    }
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

    public function submit(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $buttons = \App\Models\Button::where('member_id', $member->id)->get();

        foreach ($buttons as $button) {
            if (!$request->has('state_button_' . $button->id)) {
                $button->state = 0;
            } else {
                $button->state = 1;
            }
            if ($request->has('multiple_button_name_' . $button->id)) {
                $var = 'multiple_button_name_' . $button->id;
                $button->name = $request->$var;
            }
            if ($request->has('multiple_button_link_' . $button->id)) {
                $var = 'multiple_button_link_' . $button->id;
                $button->link = $request->$var;
            }
            $button->update();
        }

        Session::flash('flash_message', 'Member Successfully Updated');
        return redirect('/admin/');
    }

    public function render()
    {
        $buttons = \App\Models\Button::where('member_id', Auth::user()->member->id)->get();
        return view('livewire.button', compact('buttons'));
    }
}

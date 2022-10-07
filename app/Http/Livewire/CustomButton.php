<?php

namespace App\Http\Livewire;

use App\Models\Button;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CustomButton extends Component
{
    public Member $member;

    public $multiple_button_name;
    public $multiple_button_link;
    public $state_button;

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

    protected $rules = [
        'state_button.*' => 'required',
        'multiple_button_link.*' => 'required',
        'multiple_button_name.*' => 'required',
    ];

    public function submit()
    {
        $request = $this->validate();

        if(isset($request['state_button'])){
            $keys = array_keys($request['state_button']);

            foreach ($request['state_button'] as $item ){
                foreach ($keys as $key){
                    $button = Button::findOrFail($key);
                    $button->state = $item;
                    $button->update();
                }
            }
        }

        if(isset($request['multiple_button_name'])){
            $keys = array_keys($request['multiple_button_name']);

            foreach ($request['multiple_button_name'] as $item ){
                foreach ($keys as $key){
                    $button = Button::findOrFail($key);
                    $button->name = $item;
                    $button->update();
                }
            }
        }

        if(isset($request['multiple_button_link'])){
            $keys = array_keys($request['multiple_button_link']);
            foreach ($request['multiple_button_link'] as $item ){
                foreach ($keys as $key){
                    $button = Button::findOrFail($key);
                    $button->link = $item;
                    $button->update();
                }
            }
        }

        Session::flash('flash_message', 'Profile Successfully Updated');

        return redirect('/admin');
    }

    public function render()
    {
        $buttons = \App\Models\Button::where('member_id', Auth::user()->member->id)->get();
        return view('livewire.custom-button', compact('buttons'));
    }

}

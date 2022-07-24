<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Setting;
use Livewire\Component;

class Settings extends Component
{
    public $name = false;

    public Member $member;


    public function mount()
    {
        $this->member = Auth()->user()->member;
    }

    public function toggleName()
    {
        $setting = Setting::where('member_id', $this->member->id)->first();

        if($setting->name == 1){
            $setting->name = 0;
        }else {
            $setting->name = 1;
        }

        $setting->update();
    }

    public function toggleEmail()
    {
        $setting = Setting::where('member_id', $this->member->id)->first();

        if($setting->email == 1){
            $setting->email = 0;
        }else {
            $setting->email = 1;
        }

        $setting->update();
    }

    public function togglePhone()
    {
        $setting = Setting::where('member_id', $this->member->id)->first();

        if($setting->phone == 1){
            $setting->phone = 0;
        }else {
            $setting->phone = 1;
        }

        $setting->update();
    }

    public function toggleCompany()
    {
        $setting = Setting::where('member_id', $this->member->id)->first();

        if($setting->company == 1){
            $setting->company = 0;
        }else {
            $setting->company = 1;
        }

        $setting->update();
    }

    public function toggleVAT()
    {
        $setting = Setting::where('member_id', $this->member->id)->first();

        if($setting->VAT == 1){
            $setting->VAT = 0;
        }else {
            $setting->VAT = 1;
        }

        $setting->update();
    }

    public function toggleNotes()
    {
        $setting = Setting::where('member_id', $this->member->id)->first();

        if($setting->notes == 1){
            $setting->notes = 0;
        }else {
            $setting->notes = 1;
        }

        $setting->update();
    }

    public function render()
    {

        return view('livewire.settings');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\State;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class ImporterProfiles extends Component
{
    public Team $team;
    public User $user;

    public $firstname;
    public $choose_firstname = false;
    public $check_firstname = true;

    public $lastname;
    public $choose_lastname = false;
    public $email;
    public $choose_email = false;
    public $company;
    public $choose_company = false;
    public $jobTitle;
    public $choose_jobTitle = false;
    public $age;
    public $choose_age = false;
    public $website;
    public $choose_website = false;
    public $notes;
    public $choose_notes = false;

    public function mount()
    {
        $this->team = Team::findOrFail(Auth()->user()->team_id);
        $this->user = Auth()->user();
    }

    public function generateProfiles(){

        //Get selected urls from auth user
        $urls = $this->user->userToUrlImport()->where('user_id', $this->user->id)->get();

        if($urls->isEmpty()){
            session()->flash('empty_message', 'Please select accounts in your list first. You can do this by clicking the checkbox next to the account name.');
            return;
        }

        foreach ($urls as $url){
            $profile = Profile::query()
                ->where('member_id', $url->member->id)
                ->where('default', 1)
                ->select([
                    'id',
                    'firstname',
                    'lastname',
                    'email',
                    'company',
                    'age',
                    'jobTitle',
                    'notes',
                    'website',
                    'age'
                ])
                ->first();

            $state = State::query()
                ->where('profile_id', $profile->id)
                ->first();

            if($this->choose_firstname){
                $profile->firstname = $this->firstname;
                $state->firstname = $this->check_firstname;
                //Reset
                $this->choose_firstname = false;
                $this->firstname = "";
                //Detach
                Auth()->user()->userToUrlImport()->detach($url->id);
            }

            $state->update();
            $profile->update();
        }

        session()->flash('success_update_message', 'Data is updated successfully');
        $this->emit('renderImporter');
    }

    public function render()
    {
        return view('livewire.importer-profiles');
    }
}

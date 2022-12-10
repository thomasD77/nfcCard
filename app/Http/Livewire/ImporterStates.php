<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\State;
use App\Models\Team;
use App\Models\User;
use App\Swap\Importer\StateImporter;
use Livewire\Component;

class ImporterStates extends Component
{
    public Team $team;
    public User $user;

    public $check_firstname = false;
    public $check_firstname_neg = false;

    public $check_lastname = false;
    public $check_lastname_neg = false;

    public $check_email = false;
    public $check_email_neg = false;

    public $check_company = false;
    public $check_company_neg = false;

    public $check_jobTitle = false;
    public $check_jobTitle_neg = false;

    public $check_age = false;
    public $check_age_neg = false;

    public $check_website = false;
    public $check_website_neg = false;

    public $check_notes = false;
    public $check_notes_neg = false;

    public $choose_firstname = false;
    public $choose_lastname = false;
    public $choose_email = false;
    public $choose_company = false;
    public $choose_jobTitle = false;
    public $choose_age = false;
    public $choose_website = false;
    public $choose_notes = false;

    public function mount()
    {
        $this->team = Team::findOrFail(Auth()->user()->team_id);
        $this->user = Auth()->user();
    }

    public function generateStates(){

        $state_class = new StateImporter();

        //Get selected urls from auth user
        $urls = $this->user->userToUrlImport()->where('user_id', $this->user->id)->get();

        if($urls->isEmpty()){
            session()->flash('empty_message', 'Please select accounts in your list first. You can do this by clicking the checkbox next to the account name.');
            return;
        }

        foreach ($urls as $url){
            if($url->member) {
                $profile = Profile::query()
                    ->where('member_id', $url->member->id)
                    ->where('default', 1)
                    ->select([
                        'id',
                        'state_id'
                    ])
                    ->first();

                if($profile){
                    $state = State::query()
                        ->where('id', $profile->state_id)
                        ->first();

                    if($state){
                        //Set States
                        $state_class->profileState($state, 'firstname', $this->check_firstname, $this->check_firstname_neg);
                        $state_class->profileState($state, 'lastname', $this->check_lastname, $this->check_lastname_neg);
                        $state_class->profileState($state, 'email', $this->check_email, $this->check_email_neg);
                        $state_class->profileState($state, 'jobTitle', $this->check_jobTitle, $this->check_jobTitle_neg);
                        $state_class->profileState($state, 'website', $this->check_website, $this->check_website_neg);
                        $state_class->profileState($state, 'company', $this->check_company, $this->check_company_neg);
                        $state_class->profileState($state, 'age', $this->check_age, $this->check_age_neg);
                        $state_class->profileState($state, 'notes', $this->check_notes, $this->check_notes_neg);

                        $state->update();
                    }
                }
            }
        }

        //Form Reset
        $this->choose_firstname = "";
        $this->check_firstname = "";
        $this->check_firstname_neg = "";
        $this->choose_lastname = "";
        $this->check_lastname = "";
        $this->check_lastname_neg = "";
        $this->choose_email = "";
        $this->check_email = "";
        $this->check_email_neg = "";
        $this->choose_website = "";
        $this->check_website = "";
        $this->check_website_neg = "";
        $this->choose_jobTitle = "";
        $this->check_jobTitle = "";
        $this->check_jobTitle_neg = "";
        $this->choose_company = "";
        $this->check_company = "";
        $this->check_company_neg = "";
        $this->choose_age = "";
        $this->check_age = "";
        $this->check_age_neg = "";
        $this->choose_notes = "";
        $this->check_notes = "";
        $this->check_notes_neg = "";

        //Detach
        Auth()->user()->userToUrlImport()->detach($url->id);

        $this->emit('renderImporter');
        session()->flash('success_update_message', 'Data is updated successfully');
    }

    public function render()
    {
        return view('livewire.importer-states');
    }
}

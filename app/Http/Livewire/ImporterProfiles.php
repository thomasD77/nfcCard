<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\State;
use App\Models\Team;
use App\Models\User;
use App\Swap\Importer\DataImporter;
use Livewire\Component;

class ImporterProfiles extends Component
{
    public Team $team;
    public User $user;

    public $firstname;
    public $choose_firstname = false;

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

        $dataImport = new DataImporter();

        //Get selected urls from auth user
        $urls = $this->user->userToUrlImport()->where('user_id', $this->user->id)->get();

        if($urls->isEmpty()){
            session()->flash('empty_message', 'Please select accounts in your list first. You can do this by clicking the checkbox next to the account name.');
            return;
        }

        foreach ($urls as $url){
            if($url->member){
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
                        'age',
                        'state_id'
                    ])
                    ->first();

                if($profile){
                    $dataImport->profile($profile, $this->choose_firstname, 'firstname', $this->firstname);
                    $dataImport->profile($profile, $this->choose_lastname, 'lastname', $this->lastname);
                    $dataImport->profile($profile, $this->choose_email, 'email', $this->email);
                    $dataImport->profile($profile, $this->choose_website, 'website', $this->website);
                    $dataImport->profile($profile, $this->choose_jobTitle, 'jobTitle', $this->jobTitle);
                    $dataImport->profile($profile, $this->choose_company, 'company', $this->company);
                    $dataImport->profile($profile, $this->choose_age, 'age', $this->age);
                    $dataImport->profile($profile, $this->choose_notes, 'notes', $this->notes);

                    $profile->update();
                }
            }
        }

        //Form Reset
        $this->choose_firstname = "";
        $this->check_firstname = "";
        $this->choose_lastname = "";
        $this->check_lastname = "";
        $this->choose_email = "";
        $this->check_email = "";
        $this->choose_website = "";
        $this->check_website = "";
        $this->choose_jobTitle = "";
        $this->check_jobTitle = "";
        $this->choose_company = "";
        $this->check_company = "";
        $this->choose_age = "";
        $this->check_age = "";
        $this->choose_notes = "";
        $this->check_notes = "";

        //Detach
        Auth()->user()->userToUrlImport()->detach($url->id);

        $this->emit('renderImporter');
        session()->flash('success_update_message', 'Data is updated successfully');
    }

    public function render()
    {
        return view('livewire.importer-profiles');
    }
}

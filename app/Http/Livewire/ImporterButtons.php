<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\Team;
use App\Models\User;
use App\Swap\Importer\DataImporter;
use Livewire\Component;

class ImporterButtons extends Component
{
    public Team $team;
    public User $user;

    public $facebook;
    public $choose_facebook = false;

    public $instagram;
    public $choose_instagram = false;

    public $linkedIn;
    public $choose_linkedIn = false;

    public $twitter;
    public $choose_twitter = false;

    public $youTube;
    public $choose_youTube = false;

    public $tikTok;
    public $choose_tikTok = false;

    public $whatsApp;
    public $choose_whatsApp = false;

    public $customField;
    public $customText;
    public $choose_custom = false;

    public function mount()
    {
        $this->team = Team::findOrFail(Auth()->user()->team_id);
        $this->user = Auth()->user();
    }

    public function generateButtons(){

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
                        'facebook',
                        'instagram',
                        'linkedIn',
                        'twitter',
                        'youTube',
                        'tikTok',
                        'whatsApp',
                        'state_id',
                        'customField',
                        'customText'
                    ])
                    ->first();

                if($profile){
                    $dataImport->profile($profile, $this->choose_facebook, 'facebook', $this->facebook);
                    $dataImport->profile($profile, $this->choose_instagram, 'instagram', $this->instagram);
                    $dataImport->profile($profile, $this->choose_linkedIn, 'linkedIn', $this->linkedIn);
                    $dataImport->profile($profile, $this->choose_twitter, 'twitter', $this->twitter);
                    $dataImport->profile($profile, $this->choose_youTube, 'youTube', $this->youTube);
                    $dataImport->profile($profile, $this->choose_tikTok, 'tikTok', $this->tikTok);
                    $dataImport->profile($profile, $this->choose_whatsApp, 'whatsApp', $this->whatsApp);
                    $dataImport->profile($profile, $this->choose_custom, 'customField', $this->customField);
                    $dataImport->profile($profile, $this->choose_custom, 'customText', $this->customText);

                    $profile->update();
                }
            }
            //Detach
            Auth()->user()->userToUrlImport()->detach($url->id);
        }

        //Form Reset
        $this->choose_facebook = "";
        $this->facebook = "";

        $this->choose_instagram = "";
        $this->instagram = "";

        $this->choose_linkedIn = "";
        $this->linkedIn = "";

        $this->choose_twitter = "";
        $this->twitter = "";

        $this->choose_youTube = "";
        $this->youTube = "";

        $this->choose_tikTok = "";
        $this->tikTok = "";

        $this->choose_whatsApp = "";
        $this->whatsApp = "";

        $this->choose_custom = "";
        $this->customField = "";
        $this->customText = "";

        $this->emit('renderImporter');
        session()->flash('success_update_message', 'Data is updated successfully');
    }



    public function render()
    {
        return view('livewire.importer-buttons');
    }
}

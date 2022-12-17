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

    public $check_mobile = false;
    public $check_mobile_neg = false;

    public $check_mobileWork = false;
    public $check_mobileWork_neg = false;

    public $check_addressLine1 = false;
    public $check_addressLine1_neg = false;

    public $check_country = false;
    public $check_country_neg = false;

    public $check_city = false;
    public $check_city_neg = false;

    public $check_postalCode = false;
    public $check_postalCode_neg = false;

    public $check_facebook = false;
    public $check_facebook_neg = false;

    public $check_instagram = false;
    public $check_instagram_neg = false;

    public $check_twitter = false;
    public $check_twitter_neg = false;

    public $check_linkedIn = false;
    public $check_linkedIn_neg = false;

    public $check_tikTok = false;
    public $check_tikTok_neg = false;

    public $check_youTube = false;
    public $check_youTube_neg = false;

    public $check_whatsApp = false;
    public $check_whatsApp_neg = false;

    public $check_customField = false;
    public $check_customField_neg = false;

    public $check_youtubeVideo = false;
    public $check_youtubeVideo_neg = false;

    public $choose_firstname = false;
    public $choose_lastname = false;
    public $choose_email = false;
    public $choose_company = false;
    public $choose_jobTitle = false;
    public $choose_age = false;
    public $choose_website = false;
    public $choose_notes = false;
    public $choose_mobile = false;
    public $choose_mobileWork = false;
    public $choose_addressLine1 = false;
    public $choose_city = false;
    public $choose_postalCode = false;
    public $choose_country = false;
    public $choose_facebook = false;
    public $choose_instagram = false;
    public $choose_linkedIn = false;
    public $choose_twitter = false;
    public $choose_youTube = false;
    public $choose_whatsApp = false;
    public $choose_tikTok = false;
    public $choose_customField = false;
    public $choose_youtubeVideo = false;

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
                        $state_class->profileState($state, 'mobile', $this->check_mobile, $this->check_mobile_neg);
                        $state_class->profileState($state, 'mobileWork', $this->check_mobileWork, $this->check_mobileWork_neg);
                        $state_class->profileState($state, 'addressLine1', $this->check_addressLine1, $this->check_addressLine1_neg);
                        $state_class->profileState($state, 'city', $this->check_city, $this->check_city_neg);
                        $state_class->profileState($state, 'country', $this->check_country, $this->check_country_neg);
                        $state_class->profileState($state, 'postalCode', $this->check_postalCode, $this->check_postalCode_neg);
                        $state_class->profileState($state, 'facebook', $this->check_facebook, $this->check_facebook_neg);
                        $state_class->profileState($state, 'instagram', $this->check_instagram, $this->check_instagram_neg);
                        $state_class->profileState($state, 'twitter', $this->check_twitter, $this->check_twitter_neg);
                        $state_class->profileState($state, 'tikTok', $this->check_tikTok, $this->check_tikTok_neg);
                        $state_class->profileState($state, 'whatsApp', $this->check_whatsApp, $this->check_whatsApp_neg);
                        $state_class->profileState($state, 'linkedIn', $this->check_linkedIn, $this->check_linkedIn_neg);
                        $state_class->profileState($state, 'youTube', $this->check_youTube, $this->check_youTube_neg);
                        $state_class->profileState($state, 'customField', $this->check_customField, $this->check_customField_neg);
                        $state_class->profileState($state, 'youtube_video', $this->check_youtubeVideo, $this->check_youtubeVideo_neg);

                        $state->update();
                    }
                }
            }
            //Detach
            Auth()->user()->userToUrlImport()->detach($url->id);
        }

        //Form Reset
        $this->choose_firstname = "";
        $this->choose_lastname = "";
        $this->choose_email = "";
        $this->choose_company = "";
        $this->choose_jobTitle = "";
        $this->choose_age = "";
        $this->choose_website = "";
        $this->choose_notes = "";
        $this->choose_mobile = "";
        $this->choose_mobileWork = "";
        $this->choose_addressLine1 = "";
        $this->choose_city = "";
        $this->choose_postalCode = "";
        $this->choose_country = "";
        $this->choose_facebook = "";
        $this->choose_instagram = "";
        $this->choose_linkedIn = "";
        $this->choose_twitter = "";
        $this->choose_youTube = "";
        $this->choose_whatsApp = "";
        $this->choose_tikTok = "";
        $this->choose_customField = "";
        $this->choose_youtubeVideo = "";

        $this->check_firstname = "";
        $this->check_firstname_neg = "";

        $this->check_lastname = "";
        $this->check_lastname_neg = "";

        $this->check_email = "";
        $this->check_email_neg = "";

        $this->check_company = "";
        $this->check_company_neg = "";

        $this->check_jobTitle = "";
        $this->check_jobTitle_neg = "";

        $this->check_age = "";
        $this->check_age_neg = "";

        $this->check_website = "";
        $this->check_website_neg = "";

        $this->check_notes = "";
        $this->check_notes_neg = "";

        $this->check_mobile = "";
        $this->check_mobile_neg = "";

        $this->check_mobileWork = "";
        $this->check_mobileWork_neg = "";

        $this->check_addressLine1 = "";
        $this->check_addressLine1_neg = "";

        $this->check_country = "";
        $this->check_country_neg = "";

        $this->check_city = "";
        $this->check_city_neg = "";

        $this->check_postalCode = "";
        $this->check_postalCode_neg = "";

        $this->check_facebook = "";
        $this->check_facebook_neg = "";

        $this->check_instagram = "";
        $this->check_instagram_neg = "";

        $this->check_twitter = "";
        $this->check_twitter_neg = "";

        $this->check_linkedIn = "";
        $this->check_linkedIn_neg = "";

        $this->check_tikTok = "";
        $this->check_tikTok_neg = "";

        $this->check_youTube = "";
        $this->check_youTube_neg = "";

        $this->check_whatsApp = "";
        $this->check_whatsApp_neg = "";

        $this->check_customField = "";
        $this->check_customField_neg = "";

        $this->check_youtubeVideo = "";
        $this->check_youTube_neg = "";


        $this->emit('renderImporter');
        session()->flash('success_update_message', 'Data is updated successfully');
    }

    public function render()
    {
        return view('livewire.importer-states');
    }
}

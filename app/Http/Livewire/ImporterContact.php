<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\Team;
use App\Models\User;
use App\Swap\Importer\DataImporter;
use Livewire\Component;

class ImporterContact extends Component
{
    public Team $team;
    public User $user;

    public $mobile;
    public $choose_mobile = false;

    public $mobileWork;
    public $choose_mobileWork = false;

    public $addressLine1;
    public $choose_addressLine1 = false;

    public $city;
    public $choose_city = false;

    public $postalCode;
    public $choose_postalCode = false;

    public $country;
    public $choose_country = false;

    public function mount()
    {
        $this->team = Team::findOrFail(Auth()->user()->team_id);
        $this->user = Auth()->user();
    }

    public function generateContacts(){

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
                        'mobile',
                        'mobileWork',
                        'addressLine1',
                        'city',
                        'postalCode',
                        'country',
                        'state_id'
                    ])
                    ->first();

                if($profile){
                    $dataImport->profile($profile, $this->choose_mobile, 'mobile', $this->mobile);
                    $dataImport->profile($profile, $this->choose_mobileWork, 'mobileWork', $this->mobileWork);
                    $dataImport->profile($profile, $this->choose_addressLine1, 'addressLine1', $this->addressLine1);
                    $dataImport->profile($profile, $this->choose_city, 'city', $this->city);
                    $dataImport->profile($profile, $this->choose_postalCode, 'postalCode', $this->postalCode);
                    $dataImport->profile($profile, $this->choose_country, 'country', $this->country);

                    $profile->update();
                }
            }
            //Detach
            Auth()->user()->userToUrlImport()->detach($url->id);
        }

        //Form Reset
        $this->choose_mobile = "";
        $this->mobile = "";

        $this->choose_mobileWork = "";
        $this->mobileWork = "";

        $this->choose_addressLine1 = "";
        $this->addressLine1 = "";

        $this->choose_city = "";
        $this->city = "";

        $this->choose_postalCode = "";
        $this->postalCode = "";

        $this->choose_country = "";
        $this->company = "";

        $this->emit('renderImporter');
        session()->flash('success_update_message', 'Data is updated successfully');
    }


    public function render()
    {
        return view('livewire.importer-contact');
    }
}

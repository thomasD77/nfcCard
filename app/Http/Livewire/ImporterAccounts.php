<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Team;
use App\Models\URL;
use App\Models\User;
use App\Swap\Importer\AccountCreateImporter;
use App\Swap\Importer\AccountUpdateImporter;
use Faker\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ImporterAccounts extends Component
{
    public $email;
    public $password;
    public $password_confirmation;

    public Team $team;
    public User $user;

    public function mount()
    {
        $this->team = Team::findOrFail(Auth()->user()->team_id);
        $this->user = Auth()->user();
    }

    protected $rules = [
        'email' => ['nullable','string', 'email','unique:users', 'max:255','email:rfc,dns'],
        'password' => ['required'],
        'password_confirmation' => 'required|same:password'
    ];

    public function generateAccounts()
    {
        $this->validate();

        //Get selected urls from auth user
        $urls = $this->user->userToUrlImport()->where('user_id', $this->user->id)->get();

        if($urls->isEmpty()){
            session()->flash('empty_message', 'Please select accounts in your list first. You can do this by clicking the checkbox next to the account name.');
            return;
        }

        if($this->email){
            $explode_email_parts = explode( '@', $this->email, 2);
        }

        foreach ($urls as $url){

            //Make email unique by adding card ID
            if(isset($explode_email_parts[0]) && isset($explode_email_parts[1]) ){
                $explode_email =  $explode_email_parts[0] . $url->card_id . '@' . $explode_email_parts[1];
            } else {
                $explode_email =  'No valid email - ' . now();
            }

            //Check for existing emails
            $ex_email = User::where('team_id', $this->team->id)
                ->where('email', $explode_email)
                ->first();

            if($ex_email){
                session()->flash('message', 'This e-mail is all ready generated');
                return;
            }

            //When account needs update
            if(isset($url->member->user)){

                $account = new AccountUpdateImporter();
                $account->update($url, $this->team, $this->email, $this->password);

                session()->flash('success_update_message', 'E-mail is updated successfully');

            }else {

                $account = new AccountCreateImporter();
                $account->create($url, $this->team, $this->email, $this->password, $explode_email);

                session()->flash('success_message', 'E-mail is generated successfully');
            }

            //Reset form
            $this->email = "";
            $this->password = "";
            $this->password_confirmation = "";
        }

        $this->emit('renderImporter');
    }

    public function render()
    {
        return view('livewire.importer-accounts');
    }
}

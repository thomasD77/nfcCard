<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\Team;
use App\Models\User;
use App\Swap\Importer\DataImporter;
use Livewire\Component;

class ImporterMessage extends Component
{
    public Team $team;
    public User $user;

    public $titleMessage;
    public $choose_titleMessage = false;

    public $message;
    public $choose_message = false;

    public function mount()
    {
        $this->team = Team::findOrFail(Auth()->user()->team_id);
        $this->user = Auth()->user();
    }

    public function generateMessages(){

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
                        'message',
                        'titleMessage',
                        'state_id'
                    ])
                    ->first();

                if($profile){
                    $dataImport->profile($profile, $this->choose_titleMessage, 'titleMessage', $this->titleMessage);
                    $dataImport->profile($profile, $this->choose_message, 'message', $this->message);

                    $profile->update();
                }
            }
            //Detach
            Auth()->user()->userToUrlImport()->detach($url->id);
        }

        //Form Reset
        $this->choose_titleMessage = "";
        $this->titleMessage = "";
        $this->choose_message = "";
        $this->message = "";

        $this->emit('renderImporter');
        session()->flash('success_update_message', 'Data is updated successfully');
    }

    public function render()
    {
        return view('livewire.importer-message');
    }
}

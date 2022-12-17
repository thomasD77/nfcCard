<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use App\Swap\Importer\DataImporter;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;


class ImporterVideos extends Component
{
    use WithFileUploads;

    public Team $team;
    public User $user;

    public $youtubeLink;
    public $choose_youtubeLink = false;

    public $video;
    public $choose_video = false;

    public $newVideo;

    public function mount()
    {
        $this->team = Team::findOrFail(Auth()->user()->team_id);
        $this->user = Auth()->user();
    }

    public function generateVideos(){

        $dataImport = new DataImporter();

        //Get selected urls from auth user
        $urls = $this->user->userToUrlImport()->where('user_id', $this->user->id)->get();

        if($urls->isEmpty()){
            session()->flash('empty_message', 'Please select accounts in your list first. You can do this by clicking the checkbox next to the account name.');
            return;
        }

        if($this->video){
            if($this->video->getSize() <= 200000000) {
                $name = time() . $this->video->getClientOriginalName() ;
                $this->video->move('media/videos', $name);
                $this->newVideo = Video::create(['file' => $name]);
            } else{
                session()->flash('video_message', 'The video is to large. Please select another one.');
                return;
            }
        }

        foreach ($urls as $url){
            if($url->member){
                $profile = Profile::query()
                    ->where('member_id', $url->member->id)
                    ->where('default', 1)
                    ->select([
                        'id',
                        'youtube_video',
                        'video_id',
                        'state_id'
                    ])
                    ->first();

                if($profile){
                    $video = str_replace('watch?v=', 'embed/', $this->youtubeLink);
                    $dataImport->profile($profile, $this->choose_youtubeLink, 'youtube_video', $video);

                    if($this->video){
                        if($profile->video){
                            File::delete(public_path('media/videos/' . $profile->video->file));
                        }
                        $profile->video_id = $this->newVideo->id;
                    }

                    $profile->update();
                }
            }
            //Detach
            Auth()->user()->userToUrlImport()->detach($url->id);
        }

        //Form Reset
        $this->choose_youtubeLink = "";
        $this->youtubeLink = "";
        $this->choose_video = "";
        $this->video = "";

        $this->emit('renderImporter');
        session()->flash('success_update_message', 'Data is updated successfully');
    }

    public function render()
    {
        return view('livewire.importer-videos');
    }
}

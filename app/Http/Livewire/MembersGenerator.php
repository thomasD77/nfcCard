<?php

namespace App\Http\Livewire;

use App\Models\listUrl;
use App\Models\Material;
use App\Models\Member;
use App\Models\Package;
use App\Models\Role;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MembersGenerator extends Component
{
    use WithPagination;
    public $pagination = 25;


    public function select($id)
    {
        $url = listUrl::findOrFail($id);

        if($url->print == 1)
        {
            $url->print = 0;
            $url->update();
        }
        else
        {
            $url->print = 1;
            $url->update();
        }
    }


    public function render()
    {
        $urls = DB::table('list_urls')->distinct('team_id')->pluck('team_id');

        $teams = Team::with('teamUsers')
            ->whereIn('id', $urls)
            ->paginate($this->pagination);

        $ambassadors = Team::with('teamAddress')
            ->where('archived', '=', 0)
            ->pluck('name', 'id');

        return view ('livewire.members-generator', compact('teams', 'ambassadors'));
    }
}

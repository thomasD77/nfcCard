<?php

namespace App\Http\Livewire;

use App\Models\listUrl;
use App\Models\Material;
use App\Models\Team;
use Livewire\Component;
use Livewire\WithPagination;

class MembersGeneratorDetail extends Component
{
    use WithPagination;
    public $pagination = 25;

    public Team $team;

    public function mount(Team $team)
    {
        $this->team = $team;
    }


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
        $urls = listUrl::with(['package', 'material', 'member'])
            ->where('team_id', $this->team->id)
            ->simplePaginate($this->pagination);

        $materials = Material::pluck('name', 'id');
        $QRcode = \App\Models\QRCODE::first();

        return view('livewire.members-generator-detail', compact('urls',  'materials', 'QRcode'));
    }
}

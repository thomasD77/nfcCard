<?php

namespace App\Http\Livewire;

use App\Models\listUrl;
use App\Models\Material;
use App\Models\Package;
use App\Models\Role;
use App\Models\Team;
use Livewire\Component;
use Livewire\WithPagination;

class MembersGeneratorDetail extends Component
{
    use WithPagination;
    public $pagination = 25;
    public $checkbox_active = false;
    public $filter = false;

    public Team $team;

    public function mount(Team $team)
    {
        $this->team = $team;
    }

    public function toggleFilter()
    {
        if($this->filter){
            $this->filter = false;
        } else {
            $this->filter = true;
        }
    }

    public function selectAll()
    {
        if($this->checkbox_active) {

            $this->checkbox_active = false;
            $urls = listUrl::where('team_id', $this->team->id)->select('id', 'print')->get();

            foreach ($urls as $url) {
                $url->print = 0;
                $url->update();
            }

        }else {
            $urls = listUrl::where('team_id', $this->team->id)->select('id', 'print')->get();

            foreach ($urls as $url) {
                $url->print = 1;
                $url->update();
            }
            $this->checkbox_active = true;
        }
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
        $urls = listUrl::with(['package', 'material', 'member', 'listRole'])
            ->where('team_id', $this->team->id)
            ->simplePaginate($this->pagination);

        $materials = Material::pluck('name', 'id');
        $QRcode = \App\Models\QRCODE::first();

        $roles = Role::where('id', '!=', 1)->pluck('name','id');

        $materials = Material::pluck('name', 'id');

        return view('livewire.members-generator-detail', compact('urls',  'materials', 'QRcode', 'roles', 'materials'));
    }
}

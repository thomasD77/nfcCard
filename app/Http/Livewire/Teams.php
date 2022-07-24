<?php

namespace App\Http\Livewire;

use App\Models\Team;
use App\Models\Type;
use Livewire\Component;

class Teams extends Component
{
    public $search;

    public function archiveTeam(Team $team)
    {
        $team->archived = 1;
        $team->update();
    }

    public function render()
    {
        if($this->search) {
            $value = $this->search;
            $teams = Team::where(function ($q) use ($value) {
                $q->where('name', 'LIKE', '%' . $value . '%')
                    ->Orwhere('VAT', 'LIKE', '%' . $value . '%')
                    ->Orwhere('phone', 'LIKE', '%' . $value . '%')
                    ->where('archived', '=', 0);
            })->latest()->simplePaginate(25);
        }else {
            $teams = Team::query()
                ->with('teamAddress')
                ->where('archived', '=', 0)
                ->latest()
                ->simplePaginate(25);
        }

        $ambassadors = Team::query()
            ->with('teamAddress')->where('archived', '=', 0)
            ->pluck('name', 'id');

        $types = Type::pluck('name','id');

        return view('livewire.teams', compact('teams', 'ambassadors', 'types'));
    }
}

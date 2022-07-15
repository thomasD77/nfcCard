<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;

class UnarchiveTeams extends Component
{
    public function unArchiveTeam(Team $team)
    {
        $team->archived = 0;
        $team->update();
    }

    public function render()
    {
        $teams = Team::query()
            ->with('teamAddress')
            ->where('archived', '!=', 0)
            ->simplePaginate(25);

        return view('livewire.unarchive-teams', compact('teams'));
    }
}

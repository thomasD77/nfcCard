<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;

class Teams extends Component
{
    public function render()
    {
        $teams = Team::with('teamAddress')->where('archived', '=', 0)->simplePaginate(25);
        $ambassadors = Team::with('teamAddress')->where('archived', '=', 0)->pluck('name', 'id');
        return view('livewire.teams', compact('teams', 'ambassadors'));
    }
}

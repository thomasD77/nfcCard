<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Locations extends Component
{
    public function archiveLocation($id)
    {
        $location = Location::findOrFail($id);
        $location->archived = 1;
        $location->update();

    }

    public function render()
    {
        $locations = Location::where('archived', 0)
            ->latest()
            ->paginate(10);
        return view('livewire.locations', compact('locations'));
    }
}

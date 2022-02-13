<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UnarchiveLocations extends Component
{
    public function unArchiveLocation($id)
    {
        $location = Location::findOrFail($id);
        $location->archived = 0;
        $location->update();

    }

    public function render()
    {
        $locations = Location::where('archived', 1)
            ->latest()
            ->paginate(10);
        return view('livewire.unarchive-locations', compact('locations'));
    }
}

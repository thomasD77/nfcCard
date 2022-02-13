<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UnarchiveLoyals extends Component
{
    public function unArchiveLoyal($id)
    {
        $loyal = \App\Models\Loyal::findOrFail($id);
        $loyal->archived = 0;
        $loyal->update();
    }

    public function render()
    {
        $loyals = \App\Models\Loyal::where('archived', 1)
            ->paginate(10);
        return view('livewire.unarchive-loyals', compact('loyals'));
    }
}

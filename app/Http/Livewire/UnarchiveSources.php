<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UnarchiveSources extends Component
{
    public function unArchiveSource($id)
    {
        $source = \App\Models\Source::findOrFail($id);
        $source->archived = 0;
        $source->update();
    }

    public function render()
    {
        $sources = \App\Models\Source::where('archived', 1)->paginate(10);
        return view('livewire.unarchive-sources', compact('sources'));
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Promo;
use Livewire\Component;

class UnarchivePromos extends Component
{
    public function unArchivePromo($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->archived = 0;
        $promo->update();
    }

    public function render()
    {
        $promos = Promo::where('archived', 1)
            ->latest()
            ->paginate(10);
        return view('livewire.unarchive-promos', compact('promos'));
    }
}

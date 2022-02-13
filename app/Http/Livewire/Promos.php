<?php

namespace App\Http\Livewire;

use App\Models\Promo;
use Livewire\Component;

class Promos extends Component
{
    public $promoID;


    public function archivePromo($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->archived = 1;
        $promo->update();
    }

    public function render()
    {
        $promos = Promo::where('archived', 0)
            ->latest()
            ->paginate(10);
        return view('livewire.promos', compact('promos'));
    }

}

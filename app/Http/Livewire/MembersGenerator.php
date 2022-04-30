<?php

namespace App\Http\Livewire;

use App\Models\listUrl;
use App\Models\Material;
use App\Models\Member;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MembersGenerator extends Component
{
    use WithPagination;
    public $pagination = 25;


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
        $urls = listUrl::with(['package', 'material', 'member'])->simplePaginate($this->pagination);
        $materials = Material::pluck('name', 'id');
        $QRcode = \App\Models\QRCODE::first();

        return view ('livewire.members-generator', compact('urls',  'materials', 'QRcode'));
    }
}

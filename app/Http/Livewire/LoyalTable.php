<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LoyalTable extends Component
{
    public $loyal_name;
    public $newloyal;


    protected $listeners = [
        'updateLoyalsTable',
    ];

    public function archiveLoyal($id)
    {
        $loyal = \App\Models\Loyal::findOrFail($id);
        $loyal->archived = 1;
        $loyal->update();
    }

    public function updateLoyalsTable($name)
    {
        //
        $this->newloyal = $name;
    }

    protected $rules = [
        'loyal_name' => 'required',
    ];

    public function submitFormLoyal($id)
    {
        $this->validate();

        $data = [
            'loyal_name' => $this->loyal_name,
        ];


        $loyal = \App\Models\Loyal::findOrFail($id);

        $loyal->name = $this->loyal_name;

        $loyal->update();

        $this->reset([
            'loyal_name',
        ]);

        $this->dispatchBrowserEvent('closeModal');
    }

    public function removeLoyal($id)
    {
        $loyal = \App\Models\Loyal::findOrFail($id);
        $loyal->delete();
    }


    public function render()
    {
        $loyals = \App\Models\Loyal::orderBy('id', 'DESC')
            ->where('archived', 0)
            ->paginate(5);
        return view('livewire.loyal-table', compact( 'loyals'));
    }
}

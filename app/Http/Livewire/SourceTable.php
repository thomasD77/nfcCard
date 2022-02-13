<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SourceTable extends Component
{
    public $source_name;
    public $newsource;


    protected $listeners = [
        'updateSourcesTable',
    ];

    public function archiveSource($id)
    {
        $source = \App\Models\Source::findOrFail($id);
        $source->archived = 1;
        $source->update();
    }

    public function updateSourcesTable($name)
    {
        //
        $this->newsource = $name;
    }

    protected $rules = [
        'source_name' => 'required',
    ];

    public function submitFormSource($id)
    {
        $this->validate();

        $data = [
            'source_name' => $this->source_name,
        ];


        $source = \App\Models\Source::findOrFail($id);

        $source->name = $this->source_name;

        $source->update();

        $this->reset([
            'source_name',
        ]);

        $this->dispatchBrowserEvent('closeModal');
    }

    public function removeSource($id)
    {
        $source = \App\Models\Source::findOrFail($id);
        $source->delete();
    }


    public function render()
    {
        $sources = \App\Models\Source::orderBy('id', 'DESC')
            ->where('archived', 0)
            ->paginate(5);
        return view('livewire.source-table', compact( 'sources'));
    }
}

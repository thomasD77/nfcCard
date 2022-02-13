<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ToggleButtonReply extends Component
{
    public Model $model;
    public string $field;
    public string $disabled;

    public bool $statusReply;

    protected $listeners = [
        'updateStatus' => 'mount',
        'updateDisabled'
    ];

    public function updateDisabled($value)
    {
        $this->disabled = $value;
    }

    public function mount()
    {
        $this->statusReply = (bool) $this->model->getAttribute($this->field);

    }

    public function render()
    {

        return view('livewire.toggle-button-reply');
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();

    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ToggleButton extends Component
{
    public Model $model;
    public string $field;
    public bool $value = false;

    public bool $status;

   public function mount()
   {
       $this->status = (bool) $this->model->getAttribute($this->field);

   }

    public function render()
    {
        return view('livewire.toggle-button');
    }

    public function updating($field, $value)
    {
       $this->model->setAttribute($this->field, $value)->save();                                   //We save the change of the toggle button here

       if($this->model->is_active == 0 ){                                                         // We change the status of the toggle button from the comment replies when we
           $commentReplies = Comment::where('reply_id', $this->model->id)->get();                 // we set the comment value on non-active

           foreach ($commentReplies as $commentReply){
               $commentReply->is_active = 0;
               $commentReply->save();
           }
           $this->emit('updateStatus', $this->value);                                       // We emit the status to 'ToggleButtonReply class'
           $this->emit('updateDisabled', true);                                    // We emit the disabled value to 'ToggleButtonReply class'
       }else{
           $this->emit('updateDisabled', false);                                   // We emit the disabled value to 'ToggleButtonReply class'
       }

    }

}

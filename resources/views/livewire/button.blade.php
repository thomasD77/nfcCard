<div>
    <div>
        <button wire:click="createButton" class="btn btn-secondary mb-2"><i class="fa fa-plus"></i></button>
    </div>

    @if($buttons)
        @foreach($buttons as $button)
            <div class="mt-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('Button text','Button text:',['class'=>'form-label']) !!}
                        <div class="d-flex align-items-end">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="state_button_{{ $button->id }}"
                                   style="width: 31px; height: 31px"
                                   value="{{ 1 }}" @if($button->state) checked @endif>
                            <button wire:click="deleteButton({{ $button->id }})" wire:key="{{ 'item-' . $button->id }}" class="btn btn-sm btn-danger ms-4"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>

                <input name="multiple_button_name_{{ $button->id }}" type="text" class="form-control" value="{{ $button->name }}">

                <label for="">Button link:</label>
                <input name="multiple_button_link_{{ $button->id }}" class="form-control" type="text" value="{{ $button->link }}">

            </div>
        @endforeach
    @endif
</div>

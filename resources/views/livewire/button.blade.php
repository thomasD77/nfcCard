<div>
    <!-- Custom buttons  -->
    <div style="padding-top: 25px;" class="bg-light spacer"></div>
    <div class="block-header block-header-default">
        <div class="d-flex flex-column">
            <h3 class="block-title">Custom buttons</h3>
            <p class="text-muted mb-1" style="font-size: 12px">Create your custom button. Insert the text
                and link.</p>
        </div>
    </div>

    <form class="block-content" wire:submit.prevent="submit({{$member->id}})">
        <div class="row push">
            <div class="col-lg-10 offset-lg-1">
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
                                               wire:modal="state_button_{{ $button->id }}"
                                               style="width: 31px; height: 31px"
                                               value="{{ 1 }}" @if($button->state) checked @endif>
                                        <button wire:ignore.self wire:click="deleteButton({{ $button->id }})" wire:key="{{ 'item-' . $button->id }}" class="btn btn-sm btn-danger ms-4"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>

                            <input wire:modal="multiple_button_name_{{ $button->id }}" type="text" class="form-control" value="{{ $button->name }}">

                            <label for="">Button link:</label>
                            <input wire:modal="multiple_button_link_{{ $button->id }}" class="form-control" type="text" value="{{ $button->link }}">

                        </div>
                    @endforeach
                @endif

            </div>
        </div>

        <div class="d-flex justify-content-end">
            <div class="form-group m-4">
                <button type="submit" class="btn btn-alt-primary">Update</button>
            </div>
        </div>

    </form>

</div>

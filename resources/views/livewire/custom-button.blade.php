<div>
    <!-- Member profile  -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Custom buttons</h3>
            <p class="text-muted mb-1 d-none d-md-block" style="font-size: 12px">Create your custom button. Insert the text
                and link.</p>
        </div>
        <form class="block-content" wire:submit.prevent="submit">

            <div class="row push">
                <div class="col-lg-10 offset-lg-1">
                    <div class="">
                        <button wire:click="createButton" class="btn btn-secondary mb-2"><i class="fa fa-plus"></i></button>
                    </div>

                    @if($buttons)
                        @foreach($buttons as $button)

                            <div class="mt-4 p-3" wire:key="button_{{ $button->id }}" style="background-color: #f6f2f2">
                                <div class="form-check ps-0">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label class="form-label">Button text:</label>
                                        <div class="d-flex align-items-end">
{{--                                            <input class="form-check-input"--}}
{{--                                                   type="checkbox"--}}
{{--                                                   wire:model="state_button.{{ $button->id }}"--}}
{{--                                                   style="width: 31px; height: 31px"--}}
{{--                                                   value="{{ 1  }}"--}}
{{--                                                   @if($button->state == 1) checked @endif--}}
{{--                                            >--}}
                                            <button wire:click="deleteButton({{ $button->id }})" wire:key="{{ 'item-' . $button->id }}" class="btn btn-sm btn-danger ms-4"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <input wire:model="multiple_button_name.{{ $button->id }}" type="text" class="form-control mb-4" placeholder="{{ $button->name ? $button->name : "ex: Webshop" }}">

                                <label class="form-label">Button link:</label>
                                <input wire:model="multiple_button_link.{{ $button->id }}" class="form-control" type="text" placeholder="{{ $button->link ?  $button->link : "ex: https://swap-nfc.be/shop" }}">

                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

            @if(count($buttons) > 0)
                <div class="d-flex justify-content-end">
                    <div class="form-group m-4">
                        <button type="submit" class="btn btn-alt-primary">Update</button>
                    </div>
                </div>
            @endif

        </form>
    </div>
</div>

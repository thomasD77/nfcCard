<div>
    <span>
        <div class="form-check form-switch">
            <input wire:model="statusReply"
                   name="toggleReply"
                   id="toggleReply"
                   class="form-check-input"
                   type="checkbox"
                   id="flexSwitchCheckChecked"
                    @if($disabled == 1)
                    disabled
                    @endif
            >
        </div>
    </span>
</div>

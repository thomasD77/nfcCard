<div>
    <form wire:submit.prevent="generateButtons">
        <div class="alert alert-dark fs-sm mt-2">
            <div class="mt-2">
                <p class="mb-0">
                    <i class="fa fa-fw fa-info me-1 mt-0"></i>
                    ONLY select the fields you want to update. <br>
                    <i class="fa fa-fw fa-info me-1 mt-0"></i>
                    If you select a field and leave it blanc it will be overwritten.
                </p>
            </div>
        </div>

        <!-- Choose Input fields -->
        <div class="row mb-5">

            <!-- Facebook -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Facebook</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_facebook"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Instagram -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Instagram</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_instagram"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- LinkedIn -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">LinkedIn</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_linkedIn"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Twitter -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Twitter</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_twitter"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- YouTube -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">YouTube</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_youTube"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- TikTok -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">TikTok</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_tikTok"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Whatsapp -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Whatsapp</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_whatsApp"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Custom -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Custom button</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_custom"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

        </div>

        <!-- Input fields -->
        <div class="row">
        @if($choose_facebook)
            <!-- Facebook -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Facebook:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="facebook">
                    @error('facebook')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Facebook -->
        @endif

        @if($choose_instagram)
            <!-- Instagram -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Instagram:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="instagram">
                    @error('instagram')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Instagram -->
        @endif

        @if($choose_linkedIn)
            <!-- LinkedIn -->
                <div class="form-group my-4">
                    <label class="form-label" for="">LinkedIn:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="linkedIn">
                    @error('linkedIn')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End LinkedIn -->
        @endif

        @if($choose_twitter)
            <!-- Twitter -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Twitter:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="twitter">
                    @error('twitter')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Twitter -->
        @endif


        @if($choose_youTube)
            <!-- Youtube -->
                <div class="form-group my-4">
                    <label class="form-label" for="">YouTube:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="youTube">
                    @error('youTube')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Youtube -->
        @endif

        @if($choose_tikTok)
            <!-- TikTok -->
            <div class="form-group my-4">
                <label class="form-label" for="">TikTok:</label>
                <input type="text"
                       class="form-control"
                       wire:model="tikTok">
                @error('tikTok')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End TikTok -->
        @endif

        @if($choose_whatsApp)
            <!-- Whatsapp -->
            <div class="form-group my-4">
                <label class="form-label" for="">Whatsapp:</label>
                <input type="text"
                       class="form-control"
                       wire:model="whatsApp">
                @error('whatsApp')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End Whatsapp -->
        @endif

        @if($choose_custom)
        <!-- Custom buttons -->
            <div class="form-group my-4">
                <label class="form-label" for="">Button text:</label>
                <input type="text"
                       class="form-control"
                       wire:model="customText">
                @error('custom_text')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group my-4">
                <label class="form-label" for="">Button link:</label>
                <input type="text"
                       class="form-control"
                       wire:model="customField">
                @error('custom_link')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End Custom buttons -->
        @endif

        </div>

        <div class="">
            @if (session()->has('empty_message'))
                <div class="alert alert-warning">
                    {{ session('empty_message') }}
                </div>
            @endif
            @if (session()->has('success_update_message'))
                <div class="alert alert-success">
                    {{ session('success_update_message') }}
                </div>
            @endif
            <button class="btn btn-dark" type="submit">Update</button>
        </div>
    </form>
</div>

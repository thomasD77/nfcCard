<div>
    <form wire:submit.prevent="generateMessages">
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
            <!-- Title -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Title</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_titleMessage"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Message -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Message</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_message"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Input fields -->
        <div class="row">
        @if($choose_titleMessage)
            <!-- titleMessage -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Title:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="titleMessage">
                    @error('titleMessage')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End titleMessage -->
        @endif

        @if($choose_message)
            <!-- message -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Message:</label>
                    <textarea class="form-control"
                              wire:model="message">
                    </textarea>
                    @error('message')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
            <!-- End message -->
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
            <div wire:loading wire:target="generateLoading">
                <i class="fa fa-4x fa-cog fa-spin text-dark mb-2"></i>
            </div>
            <button class="btn btn-dark" wire:target="generateLoading" type="submit">Update</button>
        </div>
    </form>
</div>

<div>
    <form wire:submit.prevent="generateContacts">
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
            <!-- Mobile -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Personal Mobile</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_mobile"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Mobile -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Work Mobile</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_mobileWork"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Address</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_addressLine1"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- City -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">City</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_city"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- PostalCode -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Postal</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_postalCode"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Country -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Country</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_country"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

        </div>

        <!-- Input fields -->
        <div class="row">
        @if($choose_mobile)
            <!-- Mobile -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Personal Mobile:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="mobile">
                    @error('mobile')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Mobile -->
        @endif

        @if($choose_mobileWork)
            <!-- Mobile Work -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Work Mobile:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="mobileWork">
                    @error('mobileWork')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Mobile Work -->
        @endif

        @if($choose_addressLine1)
            <!-- Address -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Address:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="addressLine1">
                    @error('addressLine1')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Address -->
        @endif

        @if($choose_city)
            <!-- City -->
                <div class="form-group my-4">
                    <label class="form-label" for="">City:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="city">
                    @error('city')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End City -->
        @endif


        @if($choose_postalCode)
            <!-- Postalcode -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Postal Code:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="postalCode">
                    @error('postalCode')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Postalcode -->
        @endif

        @if($choose_country)
            <!-- Company -->
                <div class="form-group my-4">
                    <label class="form-label" for="">Country:</label>
                    <input type="text"
                           class="form-control"
                           wire:model="country">
                    @error('country')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Company -->
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

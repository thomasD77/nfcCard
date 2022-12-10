<div>
    <form wire:submit.prevent="generateProfiles">
        <div class="alert alert-dark fs-sm mt-2">
            <div class="mt-2">
                <p class="mb-0">
                    <i class="fa fa-fw fa-info me-1 mt-0"></i>
                    Select all the fields you want to update.
                    <br> <i class="fa fa-fw fa-info me-1 mt-0"></i>
                    You can update the data and also the state, this way you choose whether you show the data on your profile
                </p>
            </div>
        </div>

        <div class="row mb-5">
            <!-- Firstname -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Firstname</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_firstname"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Lastname -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Lastname</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_lastname"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">E-mail</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_email"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Job Title -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Job title</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_jobTitle"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Website -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Website</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_website"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Company -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Company</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_company"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Age -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Age</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_age"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Notes</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_notes"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}">
                    </div>
                </div>
            </div>
        </div>


        @if($choose_firstname)
        <!-- Firstname -->
        <div class="form-group my-4">
            <div class="form-check ps-0">
                <div class="d-flex justify-content-between mb-2">
                    <label class="form-label" for="">Firstname:</label>
                    <div>
                        <label class="form-label ms-1" for="">show on profile</label>
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="check_firstname"
                               style="width: 25px; height: 25px"
                               @if($check_firstname) checked @endif
                               value="{{ 1 }}"
                        >
                    </div>
                </div>
            </div>
            <input type="text"
                   class="form-control"
                   wire:model="firstname">
            @error('firstname')
            <p class="text-danger mt-2"> {{ $message }}</p>
            @enderror
        </div>
        <!-- End Firstname -->
        @endif

        @if($choose_lastname)
        <!-- Lastname -->
            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        <label class="form-label" for="">Lastname:</label>
                        <div>
                            <label class="form-label ms-1" for="">show on profile</label>
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="check_lastname"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}"
                            >
                        </div>
                    </div>
                </div>
                <input type="text"
                       class="form-control"
                       wire:model="lastname">
                @error('lastname')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End Lastname -->
            @endif

            @if($choose_email)
            <!-- Email -->
            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        <label class="form-label" for="">Email:</label>
                        <div>
                            <label class="form-label ms-1" for="">show on profile</label>
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="check_email"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}"
                            >
                        </div>
                    </div>
                </div>
                <input type="text"
                       class="form-control"
                       wire:model="email">
                @error('email')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End Email -->
            @endif

            @if($choose_jobTitle)
            <!-- Job Title -->
            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        <label class="form-label" for="">Job Title:</label>
                        <div>
                            <label class="form-label ms-1" for="">show on profile</label>
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="check_jobTitle"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}"
                            >
                        </div>
                    </div>
                </div>
                <input type="text"
                       class="form-control"
                       wire:model="jobTitle">
                @error('jobTitle')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End Job Title -->
            @endif


            @if($choose_website)
            <!-- Website -->
            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        <label class="form-label" for="">Website:</label>
                        <div>
                            <label class="form-label ms-1" for="">show on profile</label>
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="check_website"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}"
                            >
                        </div>
                    </div>
                </div>
                <input type="text"
                       class="form-control"
                       wire:model="website">
                @error('website')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End Website -->
            @endif

            @if($choose_company)
            <!-- Company -->
            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        <label class="form-label" for="">Company:</label>
                        <div>
                            <label class="form-label ms-1" for="">show on profile</label>
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="check_company"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}"
                            >
                        </div>
                    </div>
                </div>
                <input type="text"
                       class="form-control"
                       wire:model="company">
                @error('company')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End Company -->
            @endif

            @if($choose_age)
            <!-- Age -->
            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        <label class="form-label" for="">Age:</label>
                        <div>
                            <label class="form-label ms-1" for="">show on profile</label>
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="check_age"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}"
                            >
                        </div>
                    </div>
                </div>
                <input type="text"
                       class="form-control"
                       wire:model="age">
                @error('age')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End Age -->
            @endif

            @if($choose_notes)
            <!-- Notes -->
            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        <label class="form-label" for="">Notes:</label>
                        <div>
                            <label class="form-label ms-1" for="">show on profile</label>
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="check_notes"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}"
                            >
                        </div>
                    </div>
                </div>
                <input type="text"
                       class="form-control"
                       wire:model="notes">
                @error('notes')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <!-- End Notes -->
            @endif

        <div>
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

<div>
    <form wire:submit.prevent="generateStates">

        <div class="alert alert-dark fs-sm mt-2">
            <div class="mt-2">
                <p class="mb-0">
                    <i class="fa fa-fw fa-info me-1 mt-0"></i>
                    Select all the fields you want to update the state.
                </p>
            </div>
        </div>

        <!-- Choose State fields -->
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

        <!-- State fields -->
        <div class="row">

            @if($choose_firstname)
                <!-- Firstname -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="row">
                            <label class="form-label col-md-4" for="">Firstname:</label>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">Yes</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_firstname"
                                       style="width: 25px; height: 25px"
                                       @if($check_firstname) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">No</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_firstname_neg"
                                       style="width: 25px; height: 25px"
                                       @if($check_firstname_neg) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <!-- End Firstname -->
            @endif

            @if($choose_lastname)
                <!-- Lastname -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="row">
                            <label class="form-label col-md-4" for="">Lastname:</label>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">Yes</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_lastname"
                                       style="width: 25px; height: 25px"
                                       @if($check_lastname) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">No</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_lastname_neg"
                                       style="width: 25px; height: 25px"
                                       @if($check_lastname_neg) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <!-- End Lastname -->
            @endif

            @if($choose_email)
                <!-- Email -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="row">
                            <label class="form-label col-md-4" for="">E-mail:</label>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">Yes</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_email"
                                       style="width: 25px; height: 25px"
                                       @if($check_email) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">No</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_email_neg"
                                       style="width: 25px; height: 25px"
                                       @if($check_email_neg) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <!-- End Email -->
            @endif

            @if($choose_jobTitle)
                <!-- Job Title -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="row">
                            <label class="form-label col-md-4" for="">Job title:</label>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">Yes</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_jobTitle"
                                       style="width: 25px; height: 25px"
                                       @if($check_jobTitle) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">No</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_jobTitle_neg"
                                       style="width: 25px; height: 25px"
                                       @if($check_jobTitle_neg) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <!-- End Job Title -->
            @endif

            @if($choose_website)
                <!-- Website -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="row">
                            <label class="form-label col-md-4" for="">Website:</label>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">Yes</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_website"
                                       style="width: 25px; height: 25px"
                                       @if($check_website) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">No</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_website_neg"
                                       style="width: 25px; height: 25px"
                                       @if($check_website_neg) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <!-- End Website -->
            @endif

            @if($choose_company)
                <!-- Company -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="row">
                            <label class="form-label col-md-4" for="">Company:</label>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">Yes</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_company"
                                       style="width: 25px; height: 25px"
                                       @if($check_company) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">No</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_company_neg"
                                       style="width: 25px; height: 25px"
                                       @if($check_company_neg) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <!-- End Company -->
            @endif

            @if($choose_age)
                <!-- Age -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="row">
                            <label class="form-label col-md-4" for="">Age:</label>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">Yes</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_age"
                                       style="width: 25px; height: 25px"
                                       @if($check_age) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">No</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_age_neg"
                                       style="width: 25px; height: 25px"
                                       @if($check_age_neg) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <!-- End Age -->
            @endif

            @if($choose_notes)
                <!-- Notes -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="row">
                            <label class="form-label col-md-4" for="">Notes:</label>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">Yes</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_notes"
                                       style="width: 25px; height: 25px"
                                       @if($check_notes) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">No</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_notes_neg"
                                       style="width: 25px; height: 25px"
                                       @if($check_notes_neg) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <!-- End Notes -->
            @endif

        </div>

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

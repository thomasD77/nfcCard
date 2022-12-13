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

            <!-- mobile -->
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

            <!-- mobileWork -->
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

            <!-- addressLine1 -->
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

            <!-- city -->
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

            <!-- postalCode -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">Postal code</label>
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

            <!-- country -->
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

            <!-- facebook -->
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

            <!-- instagram -->
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

            <!-- twitter -->
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

            <!-- linkedIn -->
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

            <!-- tikTok -->
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

            <!-- whatsApp -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">WhatsApp</label>
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

            <!-- customField -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-10">
                        <label for="" class="me-2">CustomField</label>
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input"
                               type="checkbox"
                               wire:model="choose_customField"
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

            @if($choose_mobile)
                <!-- Personal Mobile -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">Personal Mobile:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_mobile"
                                           style="width: 25px; height: 25px"
                                           @if($check_mobile) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_mobile_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_mobile_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                <!-- End Personal Mobile -->
            @endif

            @if($choose_mobileWork)
                <!-- Work Mobile -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">Work Mobile:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_mobileWork"
                                           style="width: 25px; height: 25px"
                                           @if($check_mobileWork) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_mobileWork_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_mobileWork_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Work Mobile -->
                @endif

            @if($choose_addressLine1)
                <!-- Address -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">Address:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_addressLine1"
                                           style="width: 25px; height: 25px"
                                           @if($check_addressLine1) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_addressLine1_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_addressLine1_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Address -->
                @endif

                @if($choose_city)
                    <!-- City -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">City:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_city"
                                           style="width: 25px; height: 25px"
                                           @if($check_city) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_city_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_city_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End City -->
                @endif

            @if($choose_postalCode)
                <!-- Postal Code -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="row">
                            <label class="form-label col-md-4" for="">Postal Code:</label>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">Yes</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_postalCode"
                                       style="width: 25px; height: 25px"
                                       @if($check_postalCode) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label ms-1" for="">No</label>
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="check_postalCode_neg"
                                       style="width: 25px; height: 25px"
                                       @if($check_postalCode_neg) checked @endif
                                       value="{{ 1 }}">
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <!-- End postalCode -->
                @endif

                @if($choose_country)
                <!-- country -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">Country:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_country"
                                           style="width: 25px; height: 25px"
                                           @if($check_country) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_country_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_country_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End country -->
                @endif

                @if($choose_facebook)
                    <!-- facebook -->
                        <div class="form-group my-4">
                            <div class="form-check ps-0">
                                <div class="row">
                                    <label class="form-label col-md-4" for="">Facebook:</label>
                                    <div class="col-md-1">
                                        <label class="form-label ms-1" for="">Yes</label>
                                        <input class="form-check-input"
                                               type="checkbox"
                                               wire:model="check_facebook"
                                               style="width: 25px; height: 25px"
                                               @if($check_facebook) checked @endif
                                               value="{{ 1 }}">
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label ms-1" for="">No</label>
                                        <input class="form-check-input"
                                               type="checkbox"
                                               wire:model="check_facebook_neg"
                                               style="width: 25px; height: 25px"
                                               @if($check_facebook_neg) checked @endif
                                               value="{{ 1 }}">
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End facebook -->
                    @endif

                @if($choose_instagram)
                <!-- instagram -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">Instagram:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_instagram"
                                           style="width: 25px; height: 25px"
                                           @if($check_instagram) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_instagram_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_instagram_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End instagram -->
                @endif

                @if($choose_linkedIn)
                <!-- linkedIn -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">LinkedIn:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_linkedIn"
                                           style="width: 25px; height: 25px"
                                           @if($check_linkedIn) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_linkedIn_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_linkedIn_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End linkedIn -->
                @endif

                 @if($choose_twitter)
                    <!-- twitter -->
                        <div class="form-group my-4">
                            <div class="form-check ps-0">
                                <div class="row">
                                    <label class="form-label col-md-4" for="">Twitter:</label>
                                    <div class="col-md-1">
                                        <label class="form-label ms-1" for="">Yes</label>
                                        <input class="form-check-input"
                                               type="checkbox"
                                               wire:model="check_twitter"
                                               style="width: 25px; height: 25px"
                                               @if($check_twitter) checked @endif
                                               value="{{ 1 }}">
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label ms-1" for="">No</label>
                                        <input class="form-check-input"
                                               type="checkbox"
                                               wire:model="check_twitter_neg"
                                               style="width: 25px; height: 25px"
                                               @if($check_twitter_neg) checked @endif
                                               value="{{ 1 }}">
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End twitter -->
                    @endif

                    @if($choose_tikTok)
                    <!-- tikTok -->
                        <div class="form-group my-4">
                            <div class="form-check ps-0">
                                <div class="row">
                                    <label class="form-label col-md-4" for="">tikTok:</label>
                                    <div class="col-md-1">
                                        <label class="form-label ms-1" for="">Yes</label>
                                        <input class="form-check-input"
                                               type="checkbox"
                                               wire:model="check_tikTok"
                                               style="width: 25px; height: 25px"
                                               @if($check_tikTok) checked @endif
                                               value="{{ 1 }}">
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label ms-1" for="">No</label>
                                        <input class="form-check-input"
                                               type="checkbox"
                                               wire:model="check_tikTok_neg"
                                               style="width: 25px; height: 25px"
                                               @if($check_tikTok_neg) checked @endif
                                               value="{{ 1 }}">
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End tikTok -->
                    @endif

                @if($choose_youTube)
                <!-- youTube -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">YouTube:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_youTube"
                                           style="width: 25px; height: 25px"
                                           @if($check_youTube) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_youTube_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_youTube_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End youTube -->
                @endif

                @if($choose_whatsApp)
                <!-- whatsApp -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">WhatsApp:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_whatsApp"
                                           style="width: 25px; height: 25px"
                                           @if($check_whatsApp) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_whatsApp_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_whatsApp_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End whatsApp -->
                @endif

                @if($choose_customField)
                <!-- customField -->
                    <div class="form-group my-4">
                        <div class="form-check ps-0">
                            <div class="row">
                                <label class="form-label col-md-4" for="">Custom button:</label>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">Yes</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_customField"
                                           style="width: 25px; height: 25px"
                                           @if($check_customField) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label ms-1" for="">No</label>
                                    <input class="form-check-input"
                                           type="checkbox"
                                           wire:model="check_customField_neg"
                                           style="width: 25px; height: 25px"
                                           @if($check_customField_neg) checked @endif
                                           value="{{ 1 }}">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End customField -->
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

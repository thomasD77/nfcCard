<div class="row">
    <div class="col-md-8 mx-auto">
        <!-- Header -->
        <header class="header box w-100 d-flex justify-content-center">
            <div class="row mx-auto w-100">
                <div class="col-md-6">
                    @if($profile->state->avatar)
                        <div class="header__photo mx-auto ml-lg-0 mb-lg-3" style="position:relative; overflow:inherit;">
                            <img class="header__photo-img" style="border-radius: 50px;"
                                 src=" {{ $profile->avatar ? asset('card/avatars') . "/" . $profile->avatar : asset('assets/front/img/main-photo.svg')}}"
                                 alt="avatar">
                            @if($profile->state->avatar && $profile->state->logo)
                                @if($profile->logo)
                                    <img style="position:absolute; bottom:-5%; width: 40px; height: 40px; right: -10%; border-radius: 50%; border: 1px black solid;"
                                         src="{{asset($profile->logo->file)}}" alt="logo"/>
                                @endif
                            @endif
                        </div>
                    @endif
                    <div class="header__base-info">

                        @if($profile->lastname || $profile->firstname)
                            <h4 class="title titl--h4">@if($profile->state->lastname){{ $profile->lastname}}@endif @if($profile->state->firstname){{ $profile->firstname  }}@endif</h4>
                            <br>
                        @endif

                        @if($profile->company && $profile->state->company)
                            <h5 class="status">{{ $profile->company }}</h5>
                            <br>
                        @endif

                        @if($profile->jobTitle && $profile->state->jobTitle)
                            <div class="status">{{ $profile->jobTitle }}</div>
                        @endif

                        <div class="">

                        @if($profile->member->user->business)
                            <!-- Button trigger modal -->
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                                        class="btn_cstm save w-100 my-3 p-3"><i class="fa fa-rotate mr-2 "></i>SWAP
                                </button>
                                <!-- Modal -->
                            @else
                                <div class="py-4">
                                    <a href="{{ route('members.vCard', $member->card_id) }}"
                                       style="text-decoration: none; color: white"
                                       class="btn_cstm save w-100 mt-5 p-3">
                                        <i class="fa fa-floppy-disk me-1 opacity-50"></i> SAVE
                                    </a>
                                </div>
                            @endif

                            <!-- Session flash-->
                            @if(Session::has('existing_contact_message'))
                                <p class="alert alert-info my-3">{{session('existing_contact_message')}}</p>
                            @endif
                            <!-- End Session flash -->

                            @error('name')
                            <p class="text-danger mt-2 mb-0">Oops, something went wrong! </p>
                            @enderror
                            @error('email')
                            <p class="text-danger">Please try again.</p>
                            @enderror
                            @if(Session::has('recaptcha_error'))
                                <p class="text-danger">{{session('recaptcha_error')}}</p>
                            @endif
                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mt-0">
                                    <form class="row mb-0" name="contactformulier"
                                          action="{{action('App\Http\Controllers\CardController@saveInfo', $member->card_id)}}"
                                          method="post"
                                    >
                                        @csrf
                                        <div class="modal-content">
                                            <div class="d-flex justify-content-end me-3">
                                                <button type="button" class="btn_close m-2" data-bs-dismiss="modal"
                                                        aria-label="Close">X
                                                </button>
                                            </div>
                                            <div class="modal-header pt-1">
                                                <div class="d-flex flex-column">
                                                    <h2 class="talk">Let's talk!</h2>
                                                    <p>Please fill in your information. I will send you a mail to
                                                        talk later.</p>
                                                </div>
                                            </div>

                                            <div class="modal-body">
                                                @if($profile->settings)
                                                    @if($profile->settings->name)
                                                        <div class="mb-4 d-flex justify-content-start flex-column">
                                                            <label class="form-label"
                                                                   for="frontend-contact-firstname">Name</label>
                                                            <input type="text"
                                                                   class="form-control input_modal"
                                                                   name="name"
                                                                   placeholder="ex: John Doe"
                                                                   autocomplete="name"
                                                            >
                                                            @error('name')
                                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                @endif

                                                @if($profile->settings)
                                                    @if($profile->settings->email)
                                                        <div class="mb-4">
                                                            <label class="form-label" for="frontend-contact-email">Email</label>
                                                            <input type="email"
                                                                   class="form-control input_modal"
                                                                   name="email"
                                                                   autocomplete="email"
                                                                   placeholder="Enter your email...">
                                                            @error('email')
                                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                @endif

                                                @if($profile->settings)
                                                    @if($profile->settings->phone)
                                                        <label class="form-label"
                                                               for="frontend-contact-email">Phone</label>
                                                        <div class="mb-4">
                                                            <input type="text" class="form-control input_modal"
                                                                   name="phone"
                                                                   placeholder="ex: +32474413669"
                                                                   autocomplete="phone">
                                                        </div>
                                                    @endif
                                                @endif

                                                @if($profile->settings)
                                                    @if($profile->settings->company)
                                                        <div class="mb-4 d-flex justify-content-start flex-column">
                                                            <label class="form-label"
                                                                   for="frontend-contact-firstname">Company</label>
                                                            <input type="text"
                                                                   class="form-control input_modal"
                                                                   name="company"
                                                                   placeholder="Enter your company..."
                                                                   autocomplete="name"
                                                            >
                                                            @error('company')
                                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                @endif

                                                @if($profile->settings)
                                                    @if($profile->settings->VAT)
                                                        <div class="mb-4 d-flex justify-content-start flex-column">
                                                            <label class="form-label"
                                                                   for="frontend-contact-firstname">VAT</label>
                                                            <input type="text"
                                                                   class="form-control input_modal"
                                                                   name="VAT"
                                                                   placeholder="Enter your VAT..."
                                                                   autocomplete="VAT"
                                                            >
                                                            @error('VAT')
                                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                @endif

                                                @if($profile->settings)
                                                    @if($profile->settings->notes)
                                                        <div class="mb-4">

                                                            <label class="form-label" for="frontend-contact-email">Message</label>

                                                            <textarea name="message"
                                                                      placeholder="Enter your message for {{ $profile->firstname }}... "
                                                                      class="form-control input_modal" id=""
                                                                      cols="5" rows="5"></textarea>

                                                        </div>
                                                    @endif
                                                @endif

                                                <input type="hidden" name="recaptcha" id="recaptcha">

                                                <button id="closemodal" type="submit"
                                                        class="btn_cstm input_modal w-100">
                                                    <i class="fa fa-paper-plane me-1 opacity-50"></i> SEND
                                                </button>
                                                <small class="mb-3 pl-2">*I agree to the terms and conditions by
                                                    clicking send</small>

                                                <div class="bodem mb-5 pt-4 mt-5">


                                                    <div class="">
                                                        <strong>Only Save</strong>
                                                        <p>If you only want to save my contact download here.</p>
                                                    </div>

                                                    <a href="{{ route('members.vCard', $member->card_id) }}"
                                                       id="closeNow"
                                                       style="text-decoration: none; color: white"
                                                       class="btn_cstm input_modal p-3">
                                                        <i class="fa fa-floppy-disk me-1 opacity-50"></i> SAVE
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <script src="https://www.google.com/recaptcha/api.js"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-md-flex flex-md-column justify-content-md-end align-items-md-end">
                    <ul class="pl-0 pl-lg-3 w-100" style="list-style: none">
                        @if($profile->email && $profile->state->email)
                            <li class="mb-2"><span class="overhead">Email</span>
                                <a class="text-white" href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
                            </li>
                        @endif

                        @if($profile->mobileWork && $profile->state->mobileWork)
                            <li class="mb-2"><span class="overhead">Work Phone</span>
                                <a class="text-white" href="tel:{{ $profile->mobileWork }}">{{ $profile->mobileWork }}</a>
                            </li>
                        @endif

                        @if($profile->mobile && $profile->state->mobile)
                            <li class="mb-2"><span class="overhead">Personal Phone</span>
                                <a class="text-white" href="tel:{{ $profile->mobile }}">{{ $profile->mobile }}</a>
                            </li>
                        @endif
                    </ul>

                    <ul class="pl-0 pl-lg-3 w-100" style="list-style: none">
                        @if($profile->age && $profile->state->age)
                            <li class="mb-2"><span class="overhead">Birthday</span>
                                <span class="text-white">{{ \Carbon\Carbon::parse($profile->age)->format('Y-M-d') }}</span>
                            </li>
                        @endif

                        @if($profile->state->addressLine1 || $profile->state->postalCode || $profile->state->city || $profile->state->country  )
                            <li><span class="overhead">Location</span>
                                <span class="text-white">
                                             @if($profile->addressLine1 && $profile->state->addressLine1){{ $profile->addressLine1 }}, @endif
                                        </span>
                                <br>
                                <span class="text-white">@if($profile->postalCode && $profile->state->postalCode){{ $profile->postalCode }}@endif</span>
                                <span class="text-white">@if($profile->city && $profile->state->city){{ $profile->city }}@endif</span>
                                <span class="text-white">@if($profile->country && $profile->state->country){{ $profile->country }}@endif</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </header>
    </div>
</div>

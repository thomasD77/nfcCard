<!-- Member profile  -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Member Profile</h3>
    </div>
    <div class="block-content">
        <div class="row push">
            <div class="col-lg-10 offset-lg-1">
                <div class="modal fade" id="modal-{{$profile->id}}" data-profile="{{$profile->id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Crop your image here</h5>
                                <button type="button" class="btn btn-dark text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="img-container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img id="image-{{$profile->id}}" src="https://avatars0.githubusercontent.com/u/3456749" style="width: 100%">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview preview-{{$profile->id}}" id="preview-{{$profile->id}}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{--                <button type="button" class="btn btn-alt-info" id="move-picture">Move picture</button>--}}
                                {{--                <button type="button" class="btn btn-alt-info" id="move-crop">Move Crop</button>--}}
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-secondary" id="crop-{{$profile->id}}">Crop</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('active','Active',['class'=>'form-label']) !!}
                        </div>
                    </div>
                    <div class="slider-profile">
                        <input type="checkbox" name="active" class="slider-checkbox-profile" id="sliderSwitch-profile-{{$profile->id}}" value="{{ 1 }}"
                               @if($profile->active === 1) checked @endif>
                        <label class="slider-label-profile" for="sliderSwitch-profile-{{$profile->id}}">
                            <span class="slider-inner-profile"></span>
                            <span class="slider-circle-profile"></span>
                        </label>
                    </div>
                </div>
                <!-- End Active -->

                <!-- Profile name -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('profile_name','Profile name:',['class'=>'form-label']) !!}
                        </div>
                    </div>
                    {!! Form::text('profile_name',$profile->profile_name ,['class'=>'form-control']) !!}
                    @error('profile_name')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Profile name -->

                <!-- Avatar -->
                <div class="my-3">
                    <div class="mt-5 d-flex justify-content-center">
                        <img class="rounded-circle avatar-preview-{{$profile->id}}" width="160" height="160"
                             src="{{$profile->avatar ? asset('/card/avatars'). "/" . $profile->avatar : asset('/assets/front/img/Avatar-4.svg')}}"
                             alt="{{$profile->avatar}}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="alert hide-message avatar-message-{{$profile->id}}" role="alert">
                            This is a danger alert—check it out!
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="form-check ps-0">
                            <div class="d-flex justify-content-between mb-2">
                                {!! Form::label('avatar_id', 'Avatar:', ['class'=>'form-label mt-2']) !!}
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="check_avatar"
                                       style="width: 25px; height: 25px"

                                       value="{{ 1 }}" @if($profile->state->avatar) checked @endif
                                >
                            </div>
                        </div>
                        {{--{!! Form::file('avatar_id',['class'=>"form-control crop-image avatar_id-$profile->profile_name", 'data-profile'=> "$profile->profile_name"]) !!}--}}
                        <input class="form-control crop-image avatar_id avatar_id-{{$profile->id}}" data-profile="Standard 2" name="avatar_id" type="file" id="avatar_id-{{$profile->id}}">
                    </div>
                </div>
                <!-- End Avatar -->

                <!-- Start Logo -->
                <div class="my-3">
                    <div class="mt-5 d-flex justify-content-center">
                        <img class="rounded-circle logo-preview-{{$profile->id}}" width="160" height="160"
                             src="{{$profile->logo ? asset($profile->logo->file) : asset('/assets/front/img/Avatar-4.svg')}}"
                             alt="{{$profile->logo ? $profile->logo->file : "logo"}}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="alert hide-message logo-message-{{$profile->id}}" role="alert">
                            This is a danger alert—check it out!
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="form-check ps-0">
                            <div class="d-flex justify-content-between mb-2">
                                {!! Form::label('logo_id', 'Logo:', ['class'=>'form-label mt-2']) !!}
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="check_logo"
                                       style="width: 25px; height: 25px"
                                       value="{{ 1 }}" @if($profile->state->logo) checked @endif
                                >
                            </div>
                        </div>
                        {!! Form::file('logo_id',['class'=>'form-control crop-image logo_id', 'data-profile'=> "$profile->id"]) !!}
                    </div>
                </div>
                <!-- End Logo -->

                <!-- Start Banner -->
                <div class="my-3">
                    <div class="mt-5 d-flex justify-content-center">
                        <img class="banner banner-preview-{{$profile->id}}" width="300" height="150"
                             src="{{$profile->banner ? asset('/'). $profile->banner->file : asset('/assets/front/img/bg-vcard.png')}}"
                             alt="{{$profile->name}}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="alert banner-message-{{$profile->id}} hide-message">This is a message</p>
                    </div>
                    <div class="form-group mb-4">
                        <div class="form-check ps-0">
                            <div class="d-flex justify-content-between mb-2">
                                {!! Form::label('banner_id', 'Banner:', ['class'=>'form-label mt-2']) !!}
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="check_banner"
                                       style="width: 25px; height: 25px"
                                       value="{{ 1 }}" @if($profile->state->banner) checked @endif
                                >
                            </div>
                        </div>
                        {!! Form::file('banner_id',['class'=>'form-control crop-image banner_id', 'data-profile'=> "$profile->id"]) !!}
                    </div>
                </div>
                <!-- End Banner -->

                <!-- Frontend-style -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('front_style','Front Style:',['class'=>'form-label']) !!}
                        </div>
                    </div>
                    <div class="slider">
                        <input type="checkbox" name="front_style" class="slider-checkbox" id="sliderSwitch-{{$profile->id}}" value="{{ 1 }}"
                               @if($profile->front_style === "dark") checked @endif>
                        <label class="slider-label" for="sliderSwitch-{{$profile->id}}">
                            <span class="slider-inner"></span>
                            <span class="slider-circle"></span>
                        </label>
                    </div>
                </div>

                <!-- Firstname -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('firstname','Firstname:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_firstname"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($profile->state->firstname) checked @endif
                            >
                        </div>
                    </div>
                    {!! Form::text('firstname',$profile->firstname ,['class'=>'form-control']) !!}
                    @error('firstname')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Firstname -->

                <!-- Lastname -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('lastname','Lastname:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_lastname"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($profile->state->lastname) checked @endif
                            >
                        </div>
                    </div>
                    {!! Form::text('lastname',$profile->lastname ,['class'=>'form-control']) !!}
                    @error('lastname')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Lastname -->

                <!-- Email -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_email"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($profile->state->email) checked @endif
                            >
                        </div>
                    </div>
                    {!! Form::email('email',$profile->email ,['class'=>'form-control']) !!}
                    @error('email')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Email -->

                <!-- Company -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('company','Company:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_company"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($profile->state->company) checked @endif
                            >
                        </div>
                    </div>
                    {!! Form::text('company',$profile->company ,['class'=>'form-control']) !!}
                    @error('company')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Company -->

                <!-- jobTitle -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('jobTitle','Job title:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_jobTitle"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($profile->state->jobTitle) checked @endif
                            >
                        </div>
                    </div>
                    {!! Form::text('jobTitle',$profile->jobTitle ,['class'=>'form-control']) !!}
                    @error('jobTitle')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End jobTitle -->

                <!-- Age -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('age','Birthday:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_age"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($profile->state->age) checked @endif
                            >
                        </div>
                    </div>
                    {!! Form::date('age',$profile->age ,['class'=>'form-control']) !!}
                    @error('age')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Age -->

                <!-- Website -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('website','Website:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_website"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($profile->state->website) checked @endif
                            >
                        </div>
                    </div>
                    {!! Form::text('website',$profile->website ,['class'=>'form-control', 'placeholder' => 'ex: innova-webcreations.be']) !!}
                    @error('website')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Website -->

                <!-- About me -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('notes','About me:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_notes"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($profile->state->notes) checked @endif
                            >
                        </div>
                    </div>
                    {!! Form::textarea('notes',$profile->notes ,['class'=>'form-control']) !!}
                    @error('notes')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End About me -->

            </div>
        </div>
        <div class="d-flex justify-content-end">
            <div class="form-group m-4">
                <button type="submit" class="btn btn-alt-primary">Update</button>
            </div>
        </div>
    </div>
</div>

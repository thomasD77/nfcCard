<!-- Member profile  -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Company Profile</h3>
    </div>
    <div class="block-content">
        <div class="row push">
            <div class="col-lg-10 offset-lg-1">

                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" style="width: 100%">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{--                <button type="button" class="btn btn-alt-info" id="move-picture">Move picture</button>--}}
                                {{--                <button type="button" class="btn btn-alt-info" id="move-crop">Move Crop</button>--}}
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-secondary" id="crop">Crop</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Avatar -->
                <div class="my-3">
                    <div class="mt-5 d-flex justify-content-center">
                        <img class="rounded-circle avatar-preview" width="160" height="160"
                             src="{{$member->avatar ? asset('/card/avatars'). "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg')}}"
                             alt="{{$member->avatar}}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="alert hide-message avatar-message" role="alert">
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
                                       value="{{ 1 }}" @if($member->state->avatar) checked @endif>
                            </div>
                        </div>
                        {!! Form::file('avatar_id',['class'=>'form-control crop-image']) !!}
                    </div>
                </div>
                <!-- End Avatar -->

                <!-- Start Logo -->
                <div class="my-3">
                    <div class="mt-5 d-flex justify-content-center">
                        <img class="rounded-circle logo-preview" width="160" height="160"
                             src="{{$member->logo ? asset($member->logo->file) : asset('/assets/front/img/Avatar-4.svg')}}"
                             alt="{{$member->logo ? $member->logo->file : "logo"}}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="alert hide-message logo-message" role="alert">
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
                                       value="{{ 1 }}" @if($member->state->logo) checked @endif>
                            </div>
                        </div>
                        {!! Form::file('logo_id',['class'=>'form-control crop-image']) !!}
                    </div>
                </div>
                <!-- End Logo -->

                <!-- Start Banner -->
                <div class="my-3">
                    <div class="mt-5 d-flex justify-content-center">
                        <img class="banner banner-preview" width="300" height="150"
                             src="{{$member->banner ? asset('/'). $member->banner->file : asset('/assets/front/img/bg-vcard.png')}}"
                             alt="{{$member->name}}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="alert banner-message hide-message">This is a message</p>
                    </div>
                    <div class="form-group mb-4">
                        <div class="form-check ps-0">
                            <div class="d-flex justify-content-between mb-2">
                                {!! Form::label('banner_id', 'Banner:', ['class'=>'form-label mt-2']) !!}
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="check_banner"
                                       style="width: 25px; height: 25px"
                                       value="{{ 1 }}" @if($member->state->banner) checked @endif>
                            </div>
                        </div>
                        {!! Form::file('banner_id',['class'=>'form-control crop-image']) !!}
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
                        <input type="checkbox" name="front_style" class="slider-checkbox" id="sliderSwitch" value="{{ 1 }}"
                               @if($member->front_style === "dark") checked @endif>
                        <label class="slider-label" for="sliderSwitch">
                            <span class="slider-inner"></span>
                            <span class="slider-circle"></span>
                        </label>
                    </div>
                </div>

{{--                <!-- Firstname -->--}}
{{--                <div class="form-group my-4">--}}
{{--                    <div class="form-check ps-0">--}}
{{--                        <div class="d-flex justify-content-between mb-2">--}}
{{--                            {!! Form::label('firstname','Firstname:',['class'=>'form-label']) !!}--}}
{{--                            <input class="form-check-input"--}}
{{--                                   type="checkbox"--}}
{{--                                   name="check_firstname"--}}
{{--                                   style="width: 25px; height: 25px"--}}
{{--                                   value="{{ 1 }}" @if($member->state->firstname) checked @endif>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    {!! Form::text('firstname',$member->firstname ,['class'=>'form-control']) !!}--}}
{{--                    @error('firstname')--}}
{{--                    <p class="text-danger mt-2"> {{ $message }}</p>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <!-- End Firstname -->--}}

{{--                <!-- Lastname -->--}}
{{--                <div class="form-group my-4">--}}
{{--                    <div class="form-check ps-0">--}}
{{--                        <div class="d-flex justify-content-between mb-2">--}}
{{--                            {!! Form::label('lastname','Lastname:',['class'=>'form-label']) !!}--}}
{{--                            <input class="form-check-input"--}}
{{--                                   type="checkbox"--}}
{{--                                   name="check_lastname"--}}
{{--                                   style="width: 25px; height: 25px"--}}
{{--                                   value="{{ 1 }}" @if($member->state->lastname) checked @endif>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    {!! Form::text('lastname',$member->lastname ,['class'=>'form-control']) !!}--}}
{{--                    @error('lastname')--}}
{{--                    <p class="text-danger mt-2"> {{ $message }}</p>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <!-- End Lastname -->--}}


                <!-- Company -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('company','Company:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_company"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->company) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('company',$member->company ,['class'=>'form-control']) !!}
                    @error('company')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Company -->

                <!-- Email -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_email"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->email) checked @endif>
                        </div>
                    </div>
                    {!! Form::email('email',$member->email ,['class'=>'form-control']) !!}
                    @error('email')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Email -->

                <!-- jobTitle -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('jobTitle','Small title:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_jobTitle"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->jobTitle) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('jobTitle',$member->jobTitle ,['class'=>'form-control']) !!}
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
                                   value="{{ 1 }}" @if($member->state->age) checked @endif>
                        </div>
                    </div>
                    {!! Form::date('age',$member->age ,['class'=>'form-control']) !!}
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
                                   value="{{ 1 }}" @if($member->state->website) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('website',$member->website ,['class'=>'form-control', 'placeholder' => 'ex: innova-webcreations.be']) !!}
                    @error('website')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <!-- End Website -->

                <!-- About me -->
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('notes','About us:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_notes"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->notes) checked @endif>
                        </div>
                    </div>
                    {!! Form::textarea('notes',$member->notes ,['class'=>'form-control']) !!}
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

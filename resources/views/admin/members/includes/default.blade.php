{!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],'files'=>true])!!}


<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }

    .hide-message {
        display: none;
    }

    .preview {
        overflow: hidden;
        width: 200px;
        height: 200px;
        margin: 10px;
        border: 1px solid red;
    }

    .avatar_id .preview {
        border-radius: 50%;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .avatar_id .cropper-face {
        border-radius: 50%;
        border: 5px dotted black;
    }

    .avatar_id .cropper-container.cropper-bg .cropper-crop-box, .cropper-view-box {
        border-radius: 50%;
    }

    .avatar_id .cropper-view-box {
        box-shadow: 0 0 0 1px #39f;
        outline: 0 !important;
    }

    /** Slider Styling **/

    .slider {
        border: none;
        position: relative;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        width: 125px;
    }

    .slider-checkbox {
        display: none;
    }

    .slider-label {
        border: 2px solid #666;
        border-radius: 20px;
        cursor: pointer;
        display: block;
        overflow: hidden;
    }

    .slider-inner {
        display: block;
        margin-left: -100%;
        transition: margin 0.3s ease-in 0s;
        width: 200%;
    }

    .slider-inner:before,
    .slider-inner:after {
        box-sizing: border-box;
        display: block;
        float: left;
        font-family: sans-serif;
        font-size: 14px;
        font-weight: bold;
        height: 30px;
        line-height: 30px;
        padding: 0;
        width: 50%;
    }

    .slider-inner:before {
        background-color: #23262B;
        color: #fff;
        content: "DARK";
        padding-left: .75em;
    }

    .slider-inner:after {
        background-color: transparent;
        color: #666;
        content: "LIGHT";
        padding-right: .75em;
        text-align: right;
    }

    .slider-circle {
        background-color: #23262B;
        border: 2px solid #666;
        border-radius: 20px;
        bottom: 0;
        display: block;
        margin: 5px;
        position: absolute;
        right: 91px;
        top: 0;
        transition: all 0.3s ease-in 0s;
        width: 20px;
    }

    .slider-checkbox:checked + .slider-label .slider-inner {
        margin-left: 0;
    }

    .slider-checkbox:checked + .slider-label .slider-circle {
        background-color: white;
        right: 0;
    }
</style>
<body>

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


<!-- Member profile  -->
<div class="block-content">
    <div class="row push">
        <div class="col-lg-10 offset-lg-1">

            <!-- Avatar -->
            <div class="my-3">
                <div class="mb-4 d-flex justify-content-center">
                    <img class="rounded-circle avatar-preview" width="160" height="160"
                         src="{{$member->avatar ? asset('/card/avatars'). "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg')}}"
                         alt="{{$member->avatar}}">
                </div>
                <div class="d-flex justify-content-center">
                    <div class="alert hide-message avatar-message" role="alert">
                        This is a danger alert—check it out!
                    </div>
                </div>
                <div class="alert alert-dark fs-sm">
                    <div class="mt-2">
                        <p class="mb-0"><i class="fa fa-fw fa-info me-1 mb-0"></i>Don't forget! You can crop your image.
                        </p>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('avatar_id', 'Avatar:', ['class'=>'form-label']) !!}
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

            <!-- Start Banner -->
            <div class="my-3">
                <div class="mb-4 d-flex justify-content-center">
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
                            {!! Form::label('banner_id', 'Banner:', ['class'=>'form-label']) !!}
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
                {{--<div class="form-check form-switch">
                    <p>Light</p>
                    <input class="form-check-input"
                           type="checkbox"
                           name="front_style"
                           value="{{ 1 }}" @if($member->front_style === "dark") checked @endif>
                    <p>Dark</p>
                </div>--}}
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
                               value="{{ 1 }}" @if($member->state->firstname) checked @endif>
                    </div>
                </div>
                {!! Form::text('firstname',$member->firstname ,['class'=>'form-control']) !!}
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
                               value="{{ 1 }}" @if($member->state->lastname) checked @endif>
                    </div>
                </div>
                {!! Form::text('lastname',$member->lastname ,['class'=>'form-control']) !!}
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
                               value="{{ 1 }}" @if($member->state->email) checked @endif>
                    </div>
                </div>
                {!! Form::email('email',$member->email ,['class'=>'form-control']) !!}
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
                               value="{{ 1 }}" @if($member->state->company) checked @endif>
                    </div>
                </div>
                {!! Form::text('company',$member->company ,['class'=>'form-control']) !!}
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
                        {!! Form::label('notes','About me:',['class'=>'form-label']) !!}
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

<!-- Contact info -->
<div style="padding-top: 25px;" class="bg-light spacer"></div>
<div class="block-header block-header-default">
    <div class="d-flex flex-column">
        <h3 class="block-title">Contact info</h3>
        <p class="text-muted mb-1" style="font-size: 12px">Here you can edit all the default settings for your
            profile</p>
    </div>
</div>
<div class="block-content">
    <div class="row push">
        <div class="col-lg-10 offset-lg-1">

            <div class="form-group mb-4">
                <div class="form-check ps-0 ">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('mobileWork','Mobile work:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_mobileWork"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->mobileWork) checked @endif>
                    </div>
                </div>
                {!! Form::text('mobileWork',$member->mobileWork ,['class'=>'form-control']) !!}
                @error('mobileWork')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0 ">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_mobile"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->mobile) checked @endif>
                    </div>
                </div>
                {!! Form::text('mobile',$member->mobile ,['class'=>'form-control']) !!}
                @error('mobile')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0 ">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('addressLine1','Address (street and number):',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_addressLine1"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->addressLine1) checked @endif>
                    </div>
                </div>
                {!! Form::text('addressLine1',$member->addressLine1 ,['class'=>'form-control']) !!}
                @error('addressLine1')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0 ">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('city','City:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_city"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->city) checked @endif>
                    </div>
                </div>
                {!! Form::text('city',$member->city ,['class'=>'form-control']) !!}
                @error('city')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0 ">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('postalCode','Postal Code:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_postalCode"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->postalCode) checked @endif>
                    </div>
                </div>
                {!! Form::text('postalCode',$member->postalCode ,['class'=>'form-control']) !!}
                @error('postalCode')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0 ">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('country','Country:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_country"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->country) checked @endif>
                    </div>
                </div>
                {!! Form::text('country',$member->country ,['class'=>'form-control']) !!}
                @error('country')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-end">
        <div class="form-group m-4">
            <button type="submit" class="btn btn-alt-primary">Update</button>
        </div>
    </div>
</div>

<!-- Buttons -->
<div style="padding-top: 25px;" class="bg-light spacer"></div>
<div class="block-header block-header-default">
    <div class="d-flex flex-column">
        <h3 class="block-title">Buttons</h3>
        <p class="text-muted mb-1" style="font-size: 12px">Insert all your personal links here.
        </p>
    </div>
</div>
<div class="block-content">
    <div class="row push">
        <div class="col-lg-10 offset-lg-1">

            <div class="alert alert-dark fs-sm">
                <a href="https://swap-nfc.be/manual/" target="_blank">
                    <div class="d-md-flex align-items-center mt-2">
                        <p class="text-dark mb-0"><i class="fa fa-fw fa-info me-1"></i>View our manual to successfully
                            complete these functionalities: </p>
                        <p class="text-dark d-flex mt-3 mt-md-0 mb-0">
                            <i class="fa fa-book me-1 text-dark ms-md-4" style="font-size: 15px"></i>
                            SWAP MANUAL -- <strong>click here</strong>
                        </p>
                    </div>
                </a>
            </div>


            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('facebook','Facebook:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_facebook"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->facebook) checked @endif>
                    </div>
                </div>
                {!! Form::text('facebook',$member->facebook ,['class'=>'form-control col-6', 'placeholder' => 'ex: https://www.facebook.com/Innova-Webcreations-107384388503435']) !!}
                @error('facebook')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('instagram','Instagram:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_instagram"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->instagram) checked @endif>
                    </div>
                </div>
                {!! Form::text('instagram',$member->instagram ,['class'=>'form-control', 'placeholder' => 'ex: https://www.instagram.com/innovawebcreations/']) !!}
                @error('instagram')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('twitter','Twitter:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_twitter"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->twitter) checked @endif>
                    </div>
                </div>
                {!! Form::text('twitter',$member->twitter ,['class'=>'form-control', 'placeholder' => 'ex: https://twitter.com/elonmusk']) !!}
                @error('twitter')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('youTube','Youtube:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_youTube"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->youTube) checked @endif>
                    </div>
                </div>
                {!! Form::text('youTube',$member->youTube ,['class'=>'form-control' , 'placeholder' => 'ex: https://www.youtube.com/watch?v=fsDmW1o6ufA']) !!}
                @error('youTube')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('linkedIn','LinkedIn:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_linkedIn"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->linkedIn) checked @endif>
                    </div>
                </div>
                {!! Form::text('linkedIn',$member->linkedIn ,['class'=>'form-control' , 'placeholder' => 'ex: https://www.linkedin.com/in/thomas-demeulenaere-39997662/']) !!}
                @error('linkedIn')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('tikTok','TikTok:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_tikTok"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->tikTok) checked @endif>
                    </div>
                </div>
                {!! Form::text('tikTok',$member->tikTok ,['class'=>'form-control' , 'placeholder' => 'ex: https://www.tiktok.com/@elonxmusk']) !!}
                @error('tikTok')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('whatsApp','WhatsApp:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_whatsApp"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->whatsApp) checked @endif>
                    </div>
                </div>
                {!! Form::text('whatsApp',$member->whatsApp ,['class'=>'form-control' , 'placeholder' => 'ex: +32474411556']) !!}
                @error('whatsApp')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="alert alert-dark fs-sm">
                <div class="mt-2">
                    <p class="mb-0"><i class="fa fa-fw fa-info me-1 mb-0"></i>Create your custom button. Insert the text
                        and link.</p>
                </div>
            </div>

            <div class="form-group  my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('CustomText','Button text:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_customField"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->customField) checked @endif>
                    </div>
                </div>
                {!! Form::text('customText',$member->customText ,['class'=>'form-control']) !!}
                @error('customText')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
                {!! Form::label('CustomField','Button link:',['class'=>'form-label']) !!}
                {!! Form::text('customField',$member->customField ,['class'=>'form-control', 'placeholder' => 'ex: https://yourLinkHere']) !!}
                @error('customField')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-end">
        <div class="form-group m-4">
            <button type="submit" class="btn btn-alt-primary">Update</button>
        </div>
    </div>
</div>

<!-- Videos -->
<div style="padding-top: 25px;" class="bg-light spacer"></div>
<div class="block-header block-header-default" id="videos">
    <div class="d-flex flex-column">
        <h3 class="block-title">Video</h3>
        <p class="text-muted mb-1" style="font-size: 12px">Upload your video or add link. This will play automatically
            on your profile page.</p>
    </div>
</div>
<div class="block-content">
    <div class="row push">
        <div class="col-lg-10 offset-lg-1">
            <div class="form-group my-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('youtube_video','Video link:',['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_youtube_video"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->youtube_video) checked @endif>
                    </div>
                </div>
                {!! Form::text('youtube_video',$member->youtube_video ,['class'=>'form-control' , 'placeholder' => 'https://www.youtube.com/watch?v=gg8gjO5pLps']) !!}
                @error('Youtube_Video')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="row push">
        <div class="col-lg-10 offset-lg-1">
            <div class="form-group mb-4">
                <div class="form-check ps-0">
                    <div class="d-flex justify-content-between mb-2">
                        {!! Form::label('video_id', 'Video Attachment:', ['class'=>'form-label']) !!}
                        <input class="form-check-input"
                               type="checkbox"
                               name="check_video"
                               style="width: 25px; height: 25px"
                               value="{{ 1 }}" @if($member->state->video) checked @endif>
                    </div>
                </div>
                {!! Form::file('video_id',['class'=>'form-control', "accept"=>"video/mp4"]) !!}
            </div>
            @if(!$errors->isEmpty())
                @foreach ($errors->all('<p>:message</p>') as $input_error)
                    <div class="alert alert-danger">
                        {{ str_replace("</p>", "", str_replace("<p>", "", $input_error)) }}
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <div class="form-group m-4">
            <button type="submit" class="btn btn-alt-primary">Update</button>
        </div>
    </div>
</div>


<!-- Thank you  -->
<div style="padding-top: 25px;" class="bg-light spacer"></div>
<div class="block-header block-header-default">
    <div class="d-flex flex-column">
        <h3 class="block-title">Thank you message</h3>
        <p class="text-muted mb-1" style="font-size: 12px">This text will be shown when someone has entered their
            details on your form</p>
    </div>
</div>
<div class="block-content">
    <div class="row push">
        <div class="col-lg-10 offset-lg-1">
            <div class="form-group my-4">
                {!! Form::label('titleMessage','Title:',['class'=>'form-label']) !!}
                {!! Form::text('titleMessage',$member->titleMessage ,['class'=>'form-control']) !!}
                @error('titleMessage')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group my-4">
                {!! Form::label('message','Message:',['class'=>'form-label']) !!}
                {!! Form::textarea('message',$member->message ,['class'=>'form-control']) !!}
                @error('message')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <div class="form-group m-4">
            <button type="submit" class="btn btn-alt-primary">Update</button>
        </div>
    </div>

</div>

{!! Form::close() !!}

<meta name="_token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous" />--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"
      integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"
        integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
<script>

    $("body").on("change", "#banner_id", function (e) {
        let target = $(e.target);
        let files = e.target.files;
        let file = files[0];
        let ext = file.name.split(".")[1];
        let base = "media/banners/";
        let type = "banner";
        if (file.size <= 2097152) {
            if (ext === "jpg" || ext === "jpeg" || ext === "png") {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/admin/image-cropper/upload",
                        data: {
                            '_token': $('meta[name="_token"]').attr('content'),
                            'image': reader.result,
                            'name': $("#banner_id").val(),
                            "base": base,
                            "type": "banner",
                            'member_id': {{ $member->id }},
                            "uploadType": 'member'
                        },
                        success: function (data) {
                            if (data.success === "success") {
                                $("." + type + "-message").removeClass("hide-message");
                                $("." + type + "-message").removeClass("alert-danger");
                                if (!$("." + type + "-message").hasClass('alert-success')) {
                                    $("." + type + "-message").toggleClass("alert-success");
                                }
                                $("." + type + "-message").text("Successfully updated");
                                $("." + type + "-preview").attr("src", "/" + base + data.name);
                                $("#" + type + '_id').val('');
                            }
                        }
                    });
                };
                reader.readAsDataURL(file);
            } else {
                $(target).val('');
                $("." + type + "-message").removeClass("hide-message");
                $("." + type + "-message").removeClass("alert-success");
                if (!$("." + type + "-message").hasClass('alert-danger')) {
                    $("." + type + "-message").toggleClass("alert-danger");
                }
                $("." + type + "-message").text("Valid types jpg, jpeg and png");
            }
        } else{
            $(target).val('');
            $("." + type + "-message").removeClass("hide-message");
            $("." + type + "-message").removeClass("alert-success");
            if (!$("." + type + "-message").hasClass('alert-danger')) {
                $("." + type + "-message").toggleClass("alert-danger");
            }
            $("." + type + "-message").text("The image you want to upload is to big");
        }
    });


    /* AVATAR CROPPER */

    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    var aspectRatio = 1;
    var type = "avatar";
    $("body").on("change", "#avatar_id", function (e) {
        let target = $(e.target);
        $(".modal-content").addClass($(target).attr('id'));
        if ($(target).attr('id') === "banner_id") {
            aspectRatio = 2;
            type = "banner";
        } else {
            aspectRatio = 1;
            type = "avatar";
        }
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];
            if (file.size <= 2097152) {
                let ext = file.name.split(".")[1];
                if (ext === "jpg" || ext === "jpeg" || ext === "png") {
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                } else {
                    $(target).val('');
                    $modal.modal('hide');
                    $(".modal-content").addClass(type + "_id");
                    $("." + type + "-message").removeClass("hide-message");
                    $("." + type + "-message").removeClass("alert-success");
                    if (!$("." + type + "-message").hasClass('alert-danger')) {
                        $("." + type + "-message").toggleClass("alert-danger");
                    }
                    $("." + type + "-message").text("Valid types jpg, jpeg and png");
                }
            } else {
                $(target).val('');
                $modal.modal('hide');
                $(".modal-content").addClass(type + "_id");
                $("." + type + "-message").removeClass("hide-message");
                $("." + type + "-message").removeClass("alert-success");
                if (!$("." + type + "-message").hasClass('alert-danger')) {
                    $("." + type + "-message").toggleClass("alert-danger");
                }
                $("." + type + "-message").text("The image you want to upload is to big");
                //alert('The image you want to upload is to big');
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: aspectRatio,
            viewMode: 5,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
        $(".modal-content").removeClass("avatar_id");
        $(".modal-content").removeClass("banner_id");
    });

    $("#crop").click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result;
                let base = "card/avatars/";
                if (type === "banner") {
                    base = "media/banners/";
                }
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/admin/image-cropper/upload",
                    data: {
                        '_token': $('meta[name="_token"]').attr('content'),
                        'image': base64data,
                        'name': $("#" + type + "_id").val(),
                        "base": base,
                        "type": type,
                        'member_id': {{ $member->id }},
                        "uploadType": 'member'
                    },
                    success: function (data) {
                        if (data.success === "success") {
                            $modal.modal('hide');
                            $(".modal-content").addClass(type + "_id");
                            $("." + type + "-message").removeClass("hide-message");
                            $("." + type + "-message").removeClass("alert-danger");
                            if (!$("." + type + "-message").hasClass('alert-success')) {
                                $("." + type + "-message").toggleClass("alert-success");
                            }
                            $("." + type + "-message").text("Successfully updated");
                            $("." + type + "-preview").attr("src", "/" + base + data.name);
                            $("#" + type + '_id').val('');
                        } else if (data.success === "no") {
                            $modal.modal('hide');
                            $(".modal-content").addClass(type + "_id");
                            //alert('Valid image types are (.jpg , .png , .jpeg)');
                        }
                    }
                });
            }
            $(".modal-content").removeClass("avatar_id");
            $(".modal-content").removeClass("banner_id");
        });
    })

</script>

{!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],'files'=>true])!!}

<!-- Member profile  -->
<div class="block-content">
    <div class="row push">
        <div class="col-lg-10 offset-lg-1">

                <!-- Avatar -->
                <div class="my-3">
                    <div class="mb-4 d-flex justify-content-center">
                        <img class="rounded-circle" height="150" width="150"
                             src="{{$member->avatar ? asset('/card/avatars'). "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg')}}"
                             alt="{{$member->avatar}}">
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
                        {!! Form::file('avatar_id',['class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- End Avatar -->

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
</div>

<!-- Contact info -->
<div style="padding-top: 25px;" class="bg-light spacer"></div>
<div class="block-header block-header-default">
    <div class="d-flex flex-column">
        <h3 class="block-title">Contact info:</h3>
        <p class="text-muted mb-1" style="font-size: 12px">Here you can edit all the default settings for your profile</p>
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
</div>

<!-- Buttons -->
<div style="padding-top: 25px;" class="bg-light spacer"></div>
<div class="block-header block-header-default">
    <div class="d-flex flex-column">
        <h3 class="block-title">Buttons:</h3>
        <p class="text-muted mb-1" style="font-size: 12px">Insert all your personal links here.
        </p>
    </div>
</div>
<div class="block-content">
    <div class="row push">
        <div class="col-lg-10 offset-lg-1">

            <div class="alert alert-dark fs-sm">
                <a href="https://swap-nfc.be/manual/" target="_blank">
                    <div class="d-md-flex justify-content-center align-items-center mt-2">
                        <p class="text-dark mb-0"> <i class="fa fa-fw fa-info me-1"></i>View our manual to successfully complete these functionalities: </p>
                        <p class="text-dark d-flex mt-3 mt-md-0 mb-0">
                             <i class="fa fa-book me-1 text-center text-dark ms-md-4" style="font-size: 15px"></i>
                            SWAP MANUAL --  <strong>click here</strong>
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

            <p class="badge badge-pill bg-dark p-2 text-white">Create your own button here: </p>

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
</div>

<!-- Videos -->

<!-- Thank you  -->
<div style="padding-top: 25px;" class="bg-light spacer"></div>
<div class="block-header block-header-default">
    <div class="d-flex flex-column">
        <h3 class="block-title">Thank you message:</h3>
        <p class="text-muted mb-1" style="font-size: 12px">This text will be shown when someone has entered their details on your form</p>
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

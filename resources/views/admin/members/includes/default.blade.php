<div class="block-content">
    <div class="row push">
        <div class="col-lg-10">
            {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],
                'files'=>true])
           !!}
            <p class="badge badge-pill bg-dark p-2 text-white">General:</p>
            <div class="mb-4">
                <label class="form-label">Your Avatar</label>
                <div class="mb-4">
                    <img class="rounded-circle" height="150" width="150" src="{{$member->avatar ? asset('/card/avatars'). "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg')}}" alt="{{$member->avatar}}">
                </div>
                <div class="form-group mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="check_avatar" value="{{ 1 }}" @if($member->state->avatar) checked @endif>
                        {!! Form::label('avatar_id', 'Choose a new avatar:', ['class'=>'form-label']) !!}
                    </div>
                    {!! Form::file('avatar_id',['class'=>'form-control']) !!}
                </div>
            </div>


            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_firstname" value="{{ 1 }}" @if($member->state->firstname) checked @endif>
                    {!! Form::label('firstname','Firstname:',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('firstname',$member->firstname ,['class'=>'form-control']) !!}
                @error('firstname')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_lastname" value="{{ 1 }}" @if($member->state->lastname) checked @endif>
                    {!! Form::label('lastname','Lastname:',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('lastname',$member->lastname ,['class'=>'form-control']) !!}
                @error('lastname')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_email" value="{{ 1 }}" @if($member->state->email) checked @endif>
                    {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                </div>
                {!! Form::email('email',$member->email ,['class'=>'form-control']) !!}
                @error('email')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_company" value="{{ 1 }}" @if($member->state->company) checked @endif>
                    {!! Form::label('company','Company:',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('company',$member->company ,['class'=>'form-control']) !!}
                @error('company')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_age" value="{{ 1 }}" @if($member->state->age) checked @endif>
                    {!! Form::label('age','Birthday:',['class'=>'form-label']) !!}
                </div>
                {!! Form::date('age',$member->age ,['class'=>'form-control']) !!}
                @error('age')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_jobTitle" value="{{ 1 }}" @if($member->state->jobTitle) checked @endif>
                    {!! Form::label('jobTitle','Job title:',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('jobTitle',$member->jobTitle ,['class'=>'form-control']) !!}
                @error('jobTitle')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_website" value="{{ 1 }}" @if($member->state->website) checked @endif>
                    {!! Form::label('website','Website',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('website',$member->website ,['class'=>'form-control', 'placeholder' => 'ex: innova-webcreations.be']) !!}
                @error('website')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_notes" value="{{ 1 }}" @if($member->state->notes) checked @endif>
                    {!! Form::label('notes','About me:',['class'=>'form-label']) !!}
                </div>
                {!! Form::textarea('notes',$member->notes ,['class'=>'form-control']) !!}
                @error('notes')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <p class="badge badge-pill bg-dark p-2 text-white">Contact information:</p>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_mobileWork" value="{{ 1 }}" @if($member->state->mobileWork) checked @endif>
                    {!! Form::label('mobileWork','Mobile work:',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('mobileWork',$member->mobileWork ,['class'=>'form-control']) !!}
                @error('mobileWork')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_mobile" value="{{ 1 }}" @if($member->state->mobile) checked @endif>
                    {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('mobile',$member->mobile ,['class'=>'form-control']) !!}
                @error('mobile')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_addressLine1" value="{{ 1 }}" @if($member->state->addressLine1) checked @endif>
                    {!! Form::label('addressLine1','Address (street and number):',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('addressLine1',$member->addressLine1 ,['class'=>'form-control']) !!}
                @error('addressLine1')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_city" value="{{ 1 }}" @if($member->state->city) checked @endif>
                    {!! Form::label('city','City:',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('city',$member->city ,['class'=>'form-control']) !!}
                @error('city')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_postalCode" value="{{ 1 }}" @if($member->state->postalCode) checked @endif>
                    {!! Form::label('postalCode','Postal Code:',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('postalCode',$member->postalCode ,['class'=>'form-control']) !!}
                @error('postalCode')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_country" value="{{ 1 }}" @if($member->state->country) checked @endif>
                    {!! Form::label('country','Country:',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('country',$member->country ,['class'=>'form-control']) !!}
                @error('country')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <p class="badge badge-pill bg-dark p-2 text-white">Thank you message:</p>
            <div class="form-group mb-4">
                {!! Form::label('titleMessage','Title',['class'=>'form-label']) !!}
                {!! Form::text('titleMessage',$member->titleMessage ,['class'=>'form-control']) !!}
                @error('titleMessage')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('message','Message:',['class'=>'form-label']) !!}
                {!! Form::textarea('message',$member->message ,['class'=>'form-control']) !!}
                @error('message')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>


            <p class="badge badge-pill bg-dark p-2 text-white">Socials:</p>
            <p class="bg-warning-light p-2 rounded text-center">!! For these socials you need to copy the full url from your account. You can find this easily in your desktop browser !!</p>

            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_facebook" value="{{ 1 }}" @if($member->state->facebook) checked @endif>
                    {!! Form::label('facebook','Facebook',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('facebook',$member->facebook ,['class'=>'form-control col-6', 'placeholder' => 'ex: https://www.facebook.com/Innova-Webcreations-107384388503435']) !!}
                @error('facebook')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_instagram" value="{{ 1 }}" @if($member->state->instagram) checked @endif>
                    {!! Form::label('instagram','Instagram',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('instagram',$member->instagram ,['class'=>'form-control', 'placeholder' => 'ex: https://www.instagram.com/innovawebcreations/']) !!}
                @error('instagram')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_twitter" value="{{ 1 }}" @if($member->state->twitter) checked @endif>
                    {!! Form::label('twitter','Twitter',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('twitter',$member->twitter ,['class'=>'form-control', 'placeholder' => 'ex: https://twitter.com/elonmusk']) !!}
                @error('twitter')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_youTube" value="{{ 1 }}" @if($member->state->youTube) checked @endif>
                    {!! Form::label('youTube','Youtube',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('youTube',$member->youTube ,['class'=>'form-control' , 'placeholder' => 'ex: https://www.youtube.com/watch?v=fsDmW1o6ufA']) !!}
                @error('youTube')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_linkedIn" value="{{ 1 }}" @if($member->state->linkedIn) checked @endif>
                    {!! Form::label('linkedIn','LinkedIn',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('linkedIn',$member->linkedIn ,['class'=>'form-control' , 'placeholder' => 'ex: https://www.linkedin.com/in/thomas-demeulenaere-39997662/']) !!}
                @error('linkedIn')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_tikTok" value="{{ 1 }}" @if($member->state->tikTok) checked @endif>
                    {!! Form::label('tikTok','TikTok',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('tikTok',$member->tikTok ,['class'=>'form-control' , 'placeholder' => 'ex: https://www.tiktok.com/@elonxmusk']) !!}
                @error('tikTok')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_whatsApp" value="{{ 1 }}" @if($member->state->whatsApp) checked @endif>
                    {!! Form::label('whatsApp','WhatsApp',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('whatsApp',$member->whatsApp ,['class'=>'form-control' , 'placeholder' => 'ex: +32474411556']) !!}
                @error('whatsApp')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <p class="badge badge-pill bg-dark p-2 text-white">Create your own button here: </p>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_customField" value="{{ 1 }}" @if($member->state->customField) checked @endif>
                    {!! Form::label('CustomText','Button text',['class'=>'form-label']) !!}
                </div>
                {!! Form::text('customText',$member->customText ,['class'=>'form-control']) !!}
                @error('customText')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
                {!! Form::label('CustomField','Button link',['class'=>'form-label']) !!}
                {!! Form::text('customField',$member->customField ,['class'=>'form-control', 'placeholder' => 'ex: https://yourLinkHere']) !!}
                @error('customField')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <div class="form-group mr-1">
                    <button type="submit" class="btn btn-alt-primary">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

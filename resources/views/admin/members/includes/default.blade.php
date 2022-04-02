<div class="block-content">
    <div class="row push">
        <div class="col-lg-10">
            {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],
                'files'=>true])
           !!}
            <p class="badge badge-pill bg-dark p-2 text-white">General</p>
            <div class="mb-4">
                <label class="form-label">Your Avatar</label>
                <div class="mb-4">
                    <img class="rounded-circle" height="150" width="150" src="{{$member->avatar ? asset('/card/avatars'). "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg')}}" alt="{{$member->avatar}}">
                </div>
                <div class="form-group mb-4">
                    {!! Form::label('avatar_id', 'Choose a new avatar:', ['class'=>'form-label']) !!}
                    {!! Form::file('avatar_id',['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="form-group mb-4">
                {!! Form::label('firstname','Firstname:',['class'=>'form-label']) !!}
                {!! Form::text('firstname',$member->firstname ,['class'=>'form-control']) !!}
                @error('firstname')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('lastname','Lastname:',['class'=>'form-label']) !!}
                {!! Form::text('lastname',$member->lastname ,['class'=>'form-control']) !!}
                @error('lastname')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                {!! Form::email('email',$member->email ,['class'=>'form-control']) !!}
                @error('email')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('company','Company:',['class'=>'form-label']) !!}
                {!! Form::text('company',$member->company ,['class'=>'form-control']) !!}
                @error('company')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('age','Birthday:',['class'=>'form-label']) !!}
                {!! Form::date('age',$member->age ,['class'=>'form-control']) !!}
                @error('age')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('jobTitle','Job title:',['class'=>'form-label']) !!}
                {!! Form::text('jobTitle',$member->jobTitle ,['class'=>'form-control']) !!}
                @error('jobTitle')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('website','Website | example: https://innovawebcreations.be ',['class'=>'form-label']) !!}
                {!! Form::text('website',$member->website ,['class'=>'form-control']) !!}
                @error('website')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('notes','Notes:',['class'=>'form-label']) !!}
                {!! Form::textarea('notes',$member->notes ,['class'=>'form-control']) !!}
                @error('notes')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <p class="badge badge-pill bg-dark p-2 text-white">Contact information</p>
            <div class="form-group mb-4">
                {!! Form::label('mobileWork','Mobile work:',['class'=>'form-label']) !!}
                {!! Form::text('mobileWork',$member->mobileWork ,['class'=>'form-control']) !!}
                @error('mobileWork')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                {!! Form::text('mobile',$member->mobile ,['class'=>'form-control']) !!}
                @error('mobile')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('addressLine1','Address (street and number):',['class'=>'form-label']) !!}
                {!! Form::text('addressLine1',$member->addressLine1 ,['class'=>'form-control']) !!}
                @error('addressLine1')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('city','City:',['class'=>'form-label']) !!}
                {!! Form::text('city',$member->city ,['class'=>'form-control']) !!}
                @error('city')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('postalCode','Postal Code:',['class'=>'form-label']) !!}
                {!! Form::text('postalCode',$member->postalCode ,['class'=>'form-control']) !!}
                @error('postalCode')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('country','Country:',['class'=>'form-label']) !!}
                {!! Form::text('country',$member->country ,['class'=>'form-control']) !!}
                @error('country')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>


            <p class="badge badge-pill bg-dark p-2 text-white">Socials</p>
            <div class="form-group mb-4">
                {!! Form::label('facebook','Facebook | ',['class'=>'form-label']) !!}
                <span class="mb-2" style="font-style: italic">
                    {!! Form::label('facebook','example: https://www.facebook.com/Innova-Webcreations-107384388503435',['class'=> '']) !!}
                </span>
                {!! Form::text('facebook',$member->facebook ,['class'=>'form-control']) !!}
                @error('facebook')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('instagram','Instagram |',['class'=>'form-label']) !!}
                <span class="mb-2" style="font-style: italic">
                    {!! Form::label('facebook','example: https://www.instagram.com/innovawebcreations/ ',['class'=> '']) !!}
                </span>
                {!! Form::text('instagram',$member->instagram ,['class'=>'form-control']) !!}
                @error('instagram')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('twitter','Twitter | ',['class'=>'form-label']) !!}
                <span class="mb-2" style="font-style: italic">
                    {!! Form::label('facebook','example: https://twitter.com/ElonMusk ',['class'=> '']) !!}
                </span>
                {!! Form::text('twitter',$member->twitter ,['class'=>'form-control']) !!}
                @error('twitter')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('youTube','YouTube | ',['class'=>'form-label']) !!}
                <span class="mb-2" style="font-style: italic">
                    {!! Form::label('facebook','example: https://www.youtube.com/watch?v=UYmmnS-IxAE ',['class'=> '']) !!}
                </span>
                {!! Form::text('youTube',$member->youTube ,['class'=>'form-control']) !!}
                @error('youTube')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('linkedIn','LinkedIn | ',['class'=>'form-label']) !!}
                <span class="mb-2" style="font-style: italic">
                    {!! Form::label('facebook','example: https://www.linkedin.com/in/thomas-demeulenaere-39997662/',['class'=> '']) !!}
                </span>
                {!! Form::text('linkedIn',$member->linkedIn ,['class'=>'form-control']) !!}
                @error('linkedIn')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('tikTok','TikTok | ',['class'=>'form-label']) !!}
                <span class="mb-2" style="font-style: italic">
                    {!! Form::label('facebook','example: https://www.tiktok.com/@elonxmusk',['class'=> '']) !!}
                </span>
                {!! Form::text('tikTok',$member->tikTok ,['class'=>'form-control']) !!}
                @error('tikTok')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-4">
                {!! Form::label('whatsApp','WhatsApp | ',['class'=>'form-label']) !!}
                <span class="mb-2" style="font-style: italic">
                    {!! Form::label('facebook','example: https://wa.me/{phone number} = https://wa.me/32474413669 ',['class'=> '']) !!}
                </span>
                {!! Form::text('whatsApp',$member->whatsApp ,['class'=>'form-control']) !!}
                @error('whatsApp')
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

<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="rounded-circle border border-white border border-3" height="80" width="80" src="{{Auth::user()->avatar ? asset('/') . Auth::user()->avatar->file : 'http://placehold.it/62x62'}}" alt="{{Auth::user()->name}}">
            </div>
            <h1 class="h2 text-white mb-0">Update Member</h1>
            <h2 class="h4 fw-normal text-white-75">
                <?php echo Auth::user()->name; ?>
            </h2>
            <a class="btn btn-alt-secondary" href="{{ asset('/admin/members') }}">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Members
            </a>
        </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">

    <!-- member Profile -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Member Profile</h3>
        </div>

        @if($package == 'vCard')
            <div class="block-content">
            <div class="row push">
                <div class="col-lg-2">
                    <p class="fs-sm text-muted">
                        Here you can Update your Happy member.
                    </p>
                </div>
                <div class="col-lg-10">
                    {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],
                        'files'=>true])
                   !!}

                    <p>General</p>
                    <div class="form-group mb-4">
                        {!! Form::label('firstname','firstname:',['class'=>'form-label']) !!}
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
                        {!! Form::text('email',$member->email ,['class'=>'form-control']) !!}
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
                        {!! Form::label('age','Age:',['class'=>'form-label']) !!}
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
                        {!! Form::label('website','Website (use "https://") :',['class'=>'form-label']) !!}
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
                        {!! Form::label('addressLine1','Address Line 1:',['class'=>'form-label']) !!}
                        {!! Form::text('addressLine1',$member->addressLine1 ,['class'=>'form-control']) !!}
                        @error('addressLine1')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('addressLine2','Address Line 2:',['class'=>'form-label']) !!}
                        {!! Form::text('addressLine2',$member->addressLine2 ,['class'=>'form-control']) !!}
                        @error('addressLine2')
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
                        {!! Form::label('postalCode','PostalCode:',['class'=>'form-label']) !!}
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
                    <div class="d-flex justify-content-between">
                        <div class="form-group mr-1">
                            <button type="submit" class="btn btn-alt-primary">Update</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="block-content">
            <div class="row push">
                <div class="col-lg-2">
                    <p class="fs-sm text-muted">
                        Here you can Update your Happy member.
                    </p>
                </div>
                <div class="col-lg-10">
                    {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],
                        'files'=>true])
                   !!}

                    <p>General</p>
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
                        {!! Form::label('firstname','firstname:',['class'=>'form-label']) !!}
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
                        {!! Form::text('email',$member->email ,['class'=>'form-control']) !!}
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
                        {!! Form::label('age','Age:',['class'=>'form-label']) !!}
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
                        {!! Form::label('shortDescription','Short description:',['class'=>'form-label']) !!}
                        {!! Form::text('shortDescription',$member->shortDescription ,['class'=>'form-control']) !!}
                        @error('shortDescription')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('website','Website (use "https://") :',['class'=>'form-label']) !!}
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

                    <p>Contact information</p>
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
                        {!! Form::label('addressLine1','Address Line 1:',['class'=>'form-label']) !!}
                        {!! Form::text('addressLine1',$member->addressLine1 ,['class'=>'form-control']) !!}
                        @error('addressLine1')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('addressLine2','Address Line 2:',['class'=>'form-label']) !!}
                        {!! Form::text('addressLine2',$member->addressLine2 ,['class'=>'form-control']) !!}
                        @error('addressLine2')
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
                        {!! Form::label('postalCode','PostalCode:',['class'=>'form-label']) !!}
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


                    <p>Socials</p>
                    <div class="form-group mb-4">
                        {!! Form::label('facebook','Facebook (use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::text('facebook',$member->facebook ,['class'=>'form-control']) !!}
                        @error('facebook')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('instagram','Instagram (use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::text('instagram',$member->instagram ,['class'=>'form-control']) !!}
                        @error('instagram')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('twitter','Twitter (use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::text('twitter',$member->twitter ,['class'=>'form-control']) !!}
                        @error('twitter')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('youTube','YouTube (use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::text('youTube',$member->youTube ,['class'=>'form-control']) !!}
                        @error('youTube')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('linkedIn','LinkedIn (use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::text('linkedIn',$member->linkedIn ,['class'=>'form-control']) !!}
                        @error('linkedIn')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('tikTok','TikTok (use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::text('tikTok',$member->tikTok ,['class'=>'form-control']) !!}
                        @error('tikTok')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('whatsApp','WhatsApp (use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::text('whatsApp',$member->whatsApp ,['class'=>'form-control']) !!}
                        @error('whatsApp')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('facebookMessenger','Messenger (Facebook - use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::text('facebookMessenger',$member->facebookMessenger ,['class'=>'form-control']) !!}
                        @error('facebookMessenger')
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
        @endif
    </div>
    <!-- END member Profile -->
    <!-- END Page Content -->

<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>

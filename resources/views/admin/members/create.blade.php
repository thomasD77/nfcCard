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
            <h1 class="h2 text-white mb-0">{{__('Create Member')}}</h1>
            <h2 class="h4 fw-normal text-white-75">
                <?php echo Auth::user()->name; ?>
            </h2>
            <a class="btn btn-alt-secondary" href="{{ asset('/dashboard') }}">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> {{__('Back to Dashboard')}}
            </a>
        </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">

    <!-- member Profile -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{__('Member Profile')}}</h3>
        </div>
        <div class="block-content">
            <div class="row push">
                <div class="col-lg-2">
                    <p class="fs-sm text-muted">
                        {{__('Here you can create a new Happy member.')}}
                    </p>
                </div>
                <div class="col-lg-10">
                    {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminMembersController@store'],
                        'files'=>false])
                   !!}
                    <p>General</p>
                    <div class="form-group mb-4">
                        {!! Form::label('firstname','firstname:',['class'=>'form-label']) !!}
                        {!! Form::text('firstname',null ,['class'=>'form-control']) !!}
                        @error('firstname')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('lastname','Lastname:',['class'=>'form-label']) !!}
                        {!! Form::text('lastname',null ,['class'=>'form-control']) !!}
                        @error('lastname')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                        {!! Form::text('email',null ,['class'=>'form-control']) !!}
                        @error('email')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('company','Company:',['class'=>'form-label']) !!}
                        {!! Form::text('company',null ,['class'=>'form-control']) !!}
                        @error('company')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('age','Age:',['class'=>'form-label']) !!}
                        {!! Form::date('age',null ,['class'=>'form-control']) !!}
                        @error('age')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('jobTitle','Job title:',['class'=>'form-label']) !!}
                        {!! Form::text('jobTitle',null ,['class'=>'form-control']) !!}
                        @error('jobTitle')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('shortDescription','Short description:',['class'=>'form-label']) !!}
                        {!! Form::text('shortDescription',null ,['class'=>'form-control']) !!}
                        @error('shortDescription')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('website','Website (use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::text('website',null ,['class'=>'form-control']) !!}
                        @error('website')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('notes','Notes:',['class'=>'form-label']) !!}
                        {!! Form::textarea('notes',null ,['class'=>'form-control']) !!}
                        @error('notes')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>


                    <p>{{__('Contact information')}}</p>
                    <div class="form-group mb-4">
                        {!! Form::label('mobileWork','Mobile work:',['class'=>'form-label']) !!}
                        {!! Form::text('mobileWork',null ,['class'=>'form-control']) !!}
                        @error('mobileWork')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                        {!! Form::text('mobile',null ,['class'=>'form-control']) !!}
                        @error('mobile')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('addressLine1','Address Line 1:',['class'=>'form-label']) !!}
                        {!! Form::text('addressLine1',null ,['class'=>'form-control']) !!}
                        @error('addressLine1')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('addressLine2','Address Line 2:',['class'=>'form-label']) !!}
                        {!! Form::text('addressLine2',null ,['class'=>'form-control']) !!}
                        @error('addressLine2')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('city','City:',['class'=>'form-label']) !!}
                        {!! Form::text('city',null ,['class'=>'form-control']) !!}
                        @error('city')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('postalCode','PostalCode:',['class'=>'form-label']) !!}
                        {!! Form::text('postalCode',null ,['class'=>'form-control']) !!}
                        @error('postalCode')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('country','Country:',['class'=>'form-label']) !!}
                        {!! Form::text('country',null ,['class'=>'form-control']) !!}
                        @error('country')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>



                    <p>{{__('Socials')}}</p>
                    <div class="form-group mb-4">
                        {!! Form::label('facebook','Facebook:',['class'=>'form-label']) !!}
                        {!! Form::text('facebook',null ,['class'=>'form-control']) !!}
                        @error('facebook')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('instagram','Instagram:',['class'=>'form-label']) !!}
                        {!! Form::text('instagram',null ,['class'=>'form-control']) !!}
                        @error('instagram')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('twitter','Twitter:',['class'=>'form-label']) !!}
                        {!! Form::text('twitter',null ,['class'=>'form-control']) !!}
                        @error('twitter')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('youTube','YouTube:',['class'=>'form-label']) !!}
                        {!! Form::text('youTube',null ,['class'=>'form-control']) !!}
                        @error('youTube')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('linkedIn','LinkedIn:',['class'=>'form-label']) !!}
                        {!! Form::text('linkedIn',null ,['class'=>'form-control']) !!}
                        @error('linkedIn')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('tikTok','TikTok:',['class'=>'form-label']) !!}
                        {!! Form::text('tikTok',null ,['class'=>'form-control']) !!}
                        @error('tikTok')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('whatsApp','WhatsApp:',['class'=>'form-label']) !!}
                        {!! Form::text('whatsApp',null ,['class'=>'form-control']) !!}
                        @error('whatsApp')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('facebookMessenger','Messenger (Facebook):',['class'=>'form-label']) !!}
                        {!! Form::text('facebookMessenger',null ,['class'=>'form-control']) !!}
                        @error('facebookMessenger')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-group mr-1">
                            <button type="submit" class="btn btn-alt-primary">{{__('Save')}}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END member Profile -->

    </div>
<!-- END Page Content -->


<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>

<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>


<!-- Hero -->
<div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="rounded-circle border border-white border border-3" height="80" width="80" src="{{Auth::user()->avatar ? asset('/') . Auth::user()->avatar->file : 'http://placehold.it/62x62'}}" alt="{{Auth::user()->name}}">
            </div>
            <h1 class="h2 text-white mb-0">{{__('Member')}}</h1>
            <h2 class="h4 fw-normal text-white-75">
                <?php echo Auth::user()->name; ?>
            </h2>
            <a class="btn btn-alt-secondary" href="{{ asset('/admin/members') }}">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> {{__('Back to Members')}}
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
                <div class="col-lg-10 offset-lg-1">
                    <p>{{__('General')}}</p>
                    <div class="form-group mb-4">
                        {!! Form::label('firstname','firstname:',['class'=>'form-label']) !!}
                        {!! Form::label('firstname',$member->firstname ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('lastname','Lastname:',['class'=>'form-label']) !!}
                        {!! Form::label('lastname',$member->lastname  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                        {!! Form::label('email',$member->email  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('company','Company:',['class'=>'form-label']) !!}
                        {!! Form::label('company',$member->company  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('age','Age:',['class'=>'form-label']) !!}
                        {!! Form::date('age',$member->age  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('jobTitle','Job title:',['class'=>'form-label']) !!}
                        {!! Form::label('jobTitle',$member->jobTitle  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('shortDescription','Short description:',['class'=>'form-label']) !!}
                        {!! Form::label('shortDescription',$member->shortDescription  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('website','Website (use "https://") :',['class'=>'form-label']) !!}
                        {!! Form::label('website',$member->website  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('notes','Notes:',['class'=>'form-label']) !!}
                        {!! Form::label('notes',$member->notes  ,['class'=>'form-control']) !!}
                    </div>


                    <p>{{__('Contact information')}}</p>
                    <div class="form-group mb-4">
                        {!! Form::label('mobileWork','Mobile work:',['class'=>'form-label']) !!}
                        {!! Form::label('mobileWork',$member->mobileWork  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                        {!! Form::label('mobile',$member->mobile  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('addressLine1','Address Line 1:',['class'=>'form-label']) !!}
                        {!! Form::label('addressLine1',$member->addressLine1  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('addressLine2','Address Line 2:',['class'=>'form-label']) !!}
                        {!! Form::label('addressLine2',$member->addressLine2  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('city','City:',['class'=>'form-label']) !!}
                        {!! Form::label('city',$member->city  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('postalCode','PostalCode:',['class'=>'form-label']) !!}
                        {!! Form::label('postalCode',$member->postalCode  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('country','Country:',['class'=>'form-label']) !!}
                        {!! Form::label('country',$member->country  ,['class'=>'form-control']) !!}
                    </div>


                    <p>{{__('Socials')}}</p>
                    <div class="form-group mb-4">
                        {!! Form::label('facebook','Facebook:',['class'=>'form-label']) !!}
                        {!! Form::label('facebook',$member->facebook  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('instagram','Instagram:',['class'=>'form-label']) !!}
                        {!! Form::label('instagram',$member->instagram  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('twitter','Twitter:',['class'=>'form-label']) !!}
                        {!! Form::label('twitter',$member->twitter  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('youTube','YouTube:',['class'=>'form-label']) !!}
                        {!! Form::label('youTube',$member->youTube  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('linkedIn','LinkedIn:',['class'=>'form-label']) !!}
                        {!! Form::label('linkedIn',$member->linkedIn  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('tikTok','TikTok:',['class'=>'form-label']) !!}
                        {!! Form::label('tikTok',$member->tikTok  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('whatsApp','WhatsApp:',['class'=>'form-label']) !!}
                        {!! Form::label('whatsApp',$member->whatsApp  ,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('facebookMessenger','Messenger (Facebook):',['class'=>'form-label']) !!}
                        {!! Form::label('facebookMessenger',$member->facebookMessenger  ,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END member Profile -->
    <!-- END Page Content -->

<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>

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
            <h1 class="h2 text-white mb-0">Update Location</h1>
            <h2 class="h4 fw-normal text-white-75">
                <?php echo Auth::user()->name; ?>
            </h2>
            <a class="btn btn-alt-secondary" href="{{ asset('/dashboard') }}">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Dashboard
            </a>
        </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">

    <!-- Location Profile -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Location Profile</h3>
        </div>
        <div class="block-content">
            <div class="row push">
                <div class="col-lg-4">
                    <p class="fs-sm text-muted">
                        Here you can Update your Location.
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminLocationController@update', $location->id],
                        'files'=>false])
                   !!}

                    <div class="form-group mb-4">
                        {!! Form::label('name','Name:',['class'=>'form-label']) !!}
                        {!! Form::text('name',$location->name ,['class'=>'form-control']) !!}
                        @error('name')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('streetAddress','Address:',['class'=>'form-label']) !!}
                        {!! Form::text('streetAddress',$location->streetAddress ,['class'=>'form-control']) !!}
                        @error('streetAddress')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('postalCode','Postal Code:',['class'=>'form-label']) !!}
                        {!! Form::text('postalCode',$location->postalCode ,['class'=>'form-control']) !!}
                        @error('postalCode')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('city','City:',['class'=>'form-label']) !!}
                        {!! Form::text('city',$location->city ,['class'=>'form-control']) !!}
                        @error('postalCode')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                        {!! Form::text('mobile',$location->mobile ,['class'=>'form-control']) !!}
                        @error('mobile')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                        {!! Form::text('email',$location->email ,['class'=>'form-control']) !!}
                        @error('email')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('VAT','VAT:',['class'=>'form-label']) !!}
                        {!! Form::text('VAT',$location->VAT ,['class'=>'form-control']) !!}
                        @error('VAT')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    @can('is_superAdmin')
                        <div class="form-group mb-4">
                            {!! Form::label('google_calendar_id','Google Calendar Id:', ['class'=>'form-label']) !!}
                            {!! Form::text('google_calendar_id',$location->google_calendar_id,['class'=>'form-control']) !!}
                        </div>
                    @endcan

                    <div class="d-flex justify-content-between">
                        <div class="form-group mr-1">
                            <button type="submit" class="btn btn-alt-primary">Update</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Location Profile -->


<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>

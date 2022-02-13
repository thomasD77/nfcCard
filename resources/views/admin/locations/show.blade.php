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
            <h1 class="h2 text-white mb-0">Client</h1>
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

    <!-- Client Profile -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Client Profile</h3>
        </div>
        <div class="block-content">
            <div class="row push">
                <div class="col-lg-4">
                    <p class="fs-sm text-muted">
                        Here you can Check your Happy Client.
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">

                    <div class="form-group mb-4">
                        {!! Form::label('firstname','Name:',['class'=>'form-label']) !!}
                        {!! Form::label('firstname',$client->name ,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('lastname','Username:',['class'=>'form-label']) !!}
                        {!! Form::label('lastname',$client->username ,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('email','E-mail:', ['class'=>'form-label']) !!}
                        {!! Form::label('email',$client->email,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('loyal','Select Loyalty:', ['class'=>'form-label']) !!}
                        {!! Form::label('loyal_id',$client->loyal->name,['class'=>'form-control'])!!}
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('source','Select Source:', ['class'=>'form-label']) !!}
                        {!! Form::label('source_id',$client->source->name,['class'=>'form-control'])!!}
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('remarks','Remarks:',['class'=>'form-label']) !!}
                        {!! Form::label('remarks',$client->remarks ,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Client Profile -->

    <!-- Address Information -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Address Information</h3>
        </div>
        @if($client->billing)
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Address information for your Happy Client.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">

                        <div class="form-group mb-4">
                            {!! Form::label('company','Company (Optional):',['class'=>'form-label']) !!}
                            {!! Form::label('company',$client->billing->company,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('streetAddress1','Street Address 1:',['class'=>'form-label']) !!}
                            {!! Form::label('streetAddress1',$client->billing->streetAddress1,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('streetAddress2','Street Address 2 (Optional):',['class'=>'form-label']) !!}
                            {!! Form::label('streetAddress2',$client->billing->streetAddress2,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('city','City:',['class'=>'form-label']) !!}
                            {!! Form::label('city',$client->billing->city,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('postalCode','Postal Code:',['class'=>'form-label']) !!}
                            {!! Form::label('postalCode',$client->billing->postalCode,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('VAT','VAT Number:',['class'=>'form-label']) !!}
                            {!! Form::label('VAT',$client->billing->VAT,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
    @endif


    <!-- END Address Information -->

    </div>
    <!-- END Page Content -->




<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>

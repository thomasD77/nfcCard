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
            <h1 class="h2 text-white mb-0">Create Client</h1>
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
                        Here you can create a new Happy Client.
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminClientController@store'],
                        'files'=>false])
                   !!}

                    <div class="form-group mb-4">
                        {!! Form::label('name','Name:',['class'=>'form-label']) !!}
                        {!! Form::text('name',null ,['class'=>'form-control']) !!}
                        @error('name')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('username','Username:',['class'=>'form-label']) !!}
                        {!! Form::text('username',null ,['class'=>'form-control']) !!}
                        @error('username')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('email','E-mail:', ['class'=>'form-label']) !!}
                        {!! Form::text('email',null,['class'=>'form-control']) !!}
                        @error('email')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            {!! Form::label('loyal','Select Loyalty:', ['class'=>'form-label']) !!}
                            <a data-bs-toggle="tooltip" title="New Loyalty" class="btn btn-alt-primary mb-1" href="{{route('loyals.index')}}"><i class="fa fa-plus"></i></a>
                        </div>

                        {!! Form::select('loyal_id',$loyals,null,['class'=>'form-control', 'placeholder'=>'select...'])!!}
                        @error('loyal_id')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            {!! Form::label('source','Select Source:', ['class'=>'form-label']) !!}
                            <a data-bs-toggle="tooltip" title="New Source" class="btn btn-alt-primary mb-1" href="{{route('sources.index')}}"><i class="fa fa-plus"></i></a>
                        </div>
                        {!! Form::select('source_id',$sources,null,['class'=>'form-control', 'placeholder'=>'select...'])!!}
                        @error('source_id')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('remarks','Remarks:',['class'=>'form-label']) !!}
                        {!! Form::textarea('remarks',null ,['class'=>'form-control']) !!}
                        @error('remarks')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-group mr-1">
                            <button type="submit" class="btn btn-alt-primary">Save</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Client Profile -->

    </div>
<!-- END Page Content -->


<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>

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
        <h1 class="h2 text-white mb-0">Booking</h1>
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
            <h3 class="block-title">Booking Profile</h3>
        </div>
        <div class="block-content">
            <div class="row push">
                <div class="col-lg-4">
                    <p class="fs-sm text-muted">
                        Here you can Check your Booking.
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">

                    <div class="form-group mb-4">
                        @php
                            $client = \App\Models\User::where('id', $booking->client_id)->first();
                        @endphp
                        {!! Form::label('date','Client:',['class'=>'form-label']) !!}
                        {!! Form::label('date',$client->name ,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('Service(s)','Service(s):',['class'=>'form-label']) !!}
                            @foreach($booking->services as $service)
                            <label class="form-control mb-1">
                                {{ $service->name }}
                            </label>
                            @endforeach
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('date','Location:',['class'=>'form-label']) !!}
                        {!! Form::label('date',$booking->location->name ,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('date','Date:',['class'=>'form-label']) !!}
                        {!! Form::label('date',$booking->date ,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('date','Timeslots:',['class'=>'form-label']) !!}
                        {!! Form::label('date',$booking->startTime ,['class'=>'form-control']) !!}
                        {!! Form::label('date',$booking->endTime ,['class'=>'form-control mt-2']) !!}
                        <p class="mt-1">This booking will take {{ $booking->timeslot_range }} minutes.</p>
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('date','Status:',['class'=>'form-label']) !!}
                        {!! Form::label('date',$booking->status->name ,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group  mb-4">
                        {!! Form::label('remarks', 'Remarks:') !!}
                        {!! Form::label('remarks',$booking->remarks,['class'=>'form-control']) !!}
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

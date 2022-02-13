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
            <h1 class="h2 text-white mb-0">Update Client</h1>
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
                        Here you can Update your Happy Client.
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminClientController@update', $client->id],
                        'files'=>false])
                   !!}
                    <div class="form-group mb-4">
                        {!! Form::label('name','Name:',['class'=>'form-label']) !!}
                        {!! Form::text('name',$client->name ,['class'=>'form-control']) !!}
                        @error('name')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('username','Username:',['class'=>'form-label']) !!}
                        {!! Form::text('username',$client->username ,['class'=>'form-control']) !!}
                        @error('username')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('email','E-mail:', ['class'=>'form-label']) !!}
                        {!! Form::text('email',$client->email,['class'=>'form-control']) !!}
                        @error('email')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                        {!! Form::label('loyal','Select Loyalty:', ['class'=>'form-label']) !!}
                        <a data-bs-toggle="tooltip" title="New Loyalty" class="btn btn-alt-primary mb-1" href="{{route('loyals.index')}}"><i class="fa fa-plus"></i></a>
                        </div>
                        {!! Form::select('loyal_id',$loyals,$client->loyal->id,['class'=>'form-control'])!!}
                        @error('loyal_id')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                        {!! Form::label('source','Select Source:', ['class'=>'form-label']) !!}
                        <a data-bs-toggle="tooltip" title="New Source" class="btn btn-alt-primary mb-1" href="{{route('sources.index')}}"><i class="fa fa-plus"></i></a>
                        </div>
                        {!! Form::select('source_id',$sources,$client->source->id,['class'=>'form-control'])!!}
                        @error('source_id')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('remarks','Remarks:',['class'=>'form-label']) !!}
                        {!! Form::textarea('remarks',$client->remarks ,['class'=>'form-control']) !!}
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
    </div>
    <!-- END Client Profile -->

    <!-- Address Information -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Address Information</h3>
        </div>

        @if($client->billing == null)
            <div class="block-content">
            <div class="row push">
                <div class="col-lg-4">
                    <p class="fs-sm text-muted">
                        Create Address information for your Happy Client.
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">

                    {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminBillingController@store']]) !!}

                    <div class="form-group mb-4">
                        {!! Form::label('one-profile-edit-company', 'Company (Optional):',['class'=>'form-label']) !!}
                        {!! Form::text('company',$client->billing? $client->billing->company : "",['class'=>'form-control']) !!}
                        @error('company')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" value="{{$client->id}}" name="client_id">

                    <div class="row mb-4">
                        <div class="form-group col-6">
                            {!! Form::label('one-profile-edit-firstname', 'Firstname:',['class'=>'form-label']) !!}
                            {!! Form::text('firstname',$client->billing? $client->billing->firstname : "",['class'=>'form-control']) !!}
                            @error('firstname')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            {!! Form::label('one-profile-edit-lastname', 'Lastname:',['class'=>'form-label']) !!}
                            {!! Form::text('lastname',$client->billing? $client->billing->lastname : "",['class'=>'form-control']) !!}
                            @error('lastname')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('one-profile-edit-streetAddress1', 'Street Address 1:',['class'=>'form-label']) !!}
                        {!! Form::text('streetAddress1',$client->billing? $client->billing->streetAddress1 : "",['class'=>'form-control']) !!}
                        @error('streetAddress1')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('one-profile-edit-streetAddress2', 'Street Address 2 (Optional):',['class'=>'form-label']) !!}
                        {!! Form::text('streetAddress2',$client->billing? $client->billing->streetAddress2 : "",['class'=>'form-control']) !!}
                        @error('streetAddress2')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('one-profile-edit-city', 'City:',['class'=>'form-label']) !!}
                        {!! Form::text('city',$client->billing? $client->billing->city : "",['class'=>'form-control']) !!}
                        @error('city')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('one-profile-edit-postalCode', 'Postal Code:',['class'=>'form-label']) !!}
                        {!! Form::text('postalCode',$client->billing? $client->billing->postalCode : "",['class'=>'form-control']) !!}
                        @error('postalCode')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('one-profile-edit-VAT', 'VAT Number:',['class'=>'form-label']) !!}
                        {!! Form::text('VAT',$client->billing? $client->billing->VAT : "",['class'=>'form-control']) !!}
                        @error('VAT')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-group mr-1">
                            {!! Form::submit('Save',['class'=>'btn btn-alt-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Update Address information for your Happy Client.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">

                        {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminBillingController@update', $client->billing->id]]) !!}

                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-company', 'Company (Optional):',['class'=>'form-label']) !!}
                            {!! Form::text('company',$client->billing? $client->billing->company : "",['class'=>'form-control']) !!}
                            @error('company')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="form-group col-6">
                                {!! Form::label('one-profile-edit-firstname', 'Firstname:',['class'=>'form-label']) !!}
                                {!! Form::text('firstname',$client->billing? $client->billing->firstname : "",['class'=>'form-control']) !!}
                                @error('firstname')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                {!! Form::label('one-profile-edit-lastname', 'Lastname:',['class'=>'form-label']) !!}
                                {!! Form::text('lastname',$client->billing? $client->billing->lastname : "",['class'=>'form-control']) !!}
                                @error('lastname')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-streetAddress1', 'Street Address 1:',['class'=>'form-label']) !!}
                            {!! Form::text('streetAddress1',$client->billing? $client->billing->streetAddress1 : "",['class'=>'form-control']) !!}
                            @error('streetAddress1')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-streetAddress2', 'Street Address 2 (Optional):',['class'=>'form-label']) !!}
                            {!! Form::text('streetAddress2',$client->billing? $client->billing->streetAddress2 : "",['class'=>'form-control']) !!}
                            @error('streetAddress2')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-city', 'City:',['class'=>'form-label']) !!}
                            {!! Form::text('city',$client->billing? $client->billing->city : "",['class'=>'form-control']) !!}
                            @error('city')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-postalCode', 'Postal Code:',['class'=>'form-label']) !!}
                            {!! Form::text('postalCode',$client->billing? $client->billing->postalCode : "",['class'=>'form-control']) !!}
                            @error('postalCode')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-VAT', 'VAT Number:',['class'=>'form-label']) !!}
                            {!! Form::text('VAT',$client->billing? $client->billing->VAT : "",['class'=>'form-control']) !!}
                            @error('VAT')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="form-group mr-1">
                                {!! Form::submit('Save',['class'=>'btn btn-alt-primary']) !!}
                            </div>
                            {!! Form::close() !!}
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

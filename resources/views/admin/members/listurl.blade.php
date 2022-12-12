@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Edit
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ asset('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            LISTURL
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed px-0 my-4 rounded" style="background-color: #ffffff">
        <div class="content content-boxed">
                <div class="text-end">
                    <a href="{{ route('card-credentials-details', $url->team_id ) }}" class="btn btn-secondary">Back</a>

                </div>
                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\Cards\CardCredentialsController@updateCard', $url->id], 'files'=>false]) !!}
                @csrf
                <div class="form-group mb-4">

                    <div class="form-group mb-4">
                        <label class="form-label">Importer:</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" value="1" name="is_importer" type="checkbox" id="flexSwitchCheckDefault" @if($url->is_importer) checked @endif>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Company account:</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" value="1" name="is_company" type="checkbox" id="flexSwitchCheckDefault" @if($url->is_company) checked @endif>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Business account:</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" value="1" name="business" type="checkbox" id="flexSwitchCheckDefault" @if($url->business) checked @endif>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('one-profile-edit-email', 'Reservation for:', ['class'=>'form-label']) !!}
                        {!! Form::text('reservation',$url->reservation,['class'=>'form-control']) !!}
                        @error('reservation')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        {!! Form::label('one-profile-edit-email', 'Image:', ['class'=>'form-label']) !!}
                        {!! Form::text('image',$url->image,['class'=>'form-control']) !!}
                        @error('image')
                        <p class="text-danger mt-2"> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="d-flex flex-column mt-4">
                        {!! Form::label('role','Select Role:', ['class'=>'form-label']) !!}
                        {!! Form::select('role_id',$roles,$url->role_id,['class'=>'form-control'])!!}
                    </div>

                    {!! Form::hidden('url_id',$url->card_id)!!}

                    <div class="d-flex flex-column mt-4">
                        {!! Form::label('material_id','Select Material:', ['class'=>'form-label']) !!}
                        {!! Form::select('material_id',$materials,$url->material_id,['class'=>'form-control'])!!}
                    </div>

                    <div class="d-flex flex-column mt-4">
                        {!! Form::label('type_id','Select type:', ['class'=>'form-label']) !!}
                        {!! Form::select('type_id',$types,$url->type_id,['class'=>'form-control', 'placeholder' => 'Select here...'])!!}
                    </div>

{{--                    If Test card--}}
                    @if($url->listType->id == 8 )
                        <div class="form-check mt-4 px-0">
                            {!! Form::label('date','Select end trial date:', ['class'=>'form-label']) !!}
                            {!! Form::date('trial_date', $url->trial_date,['class'=>'form-control'])!!}
                        </div>
                    @endif

{{--                    If webshop--}}
                    @if($url->listType->id == 2 )
                        <div class="form-group my-4">
                            {!! Form::label('webshop_order_id', 'Webshop Order ID:', ['class'=>'form-label']) !!}
                            {!! Form::text('webshop_order_id',$url->webshop_order_id,['class'=>'form-control']) !!}
                            @error('webshop_order_id')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <div class="d-flex flex-column mt-4">
                        <a class="form-label text-dark d-flex justify-content-between" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                            Custom Card url <i class="fa fa-arrow-down"></i>
                        </a>
                        <div class="collapse" id="collapseExample2">
                            <input class="form-control" type="text" name="custom_url" value="{{ $url->memberURL }}">                                                                </div>
                    </div>
                    @if($QRcode->status == 1)
                        <div class="d-flex flex-column mt-4">
                            <a class="form-label text-dark d-flex justify-content-between" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Custom QRCODE url <i class="fa fa-arrow-down"></i>
                            </a>
                            <div class="collapse" id="collapseExample">
                                <input class="form-control" type="text" value="{{ $url->custom_QR_url  }}" name="input_QR_url">
                            </div>
                        </div>
                    @endif

                </div>



                <div class="text-end pb-4">


                    <button type="submit" class="btn btn-secondary">Save</button>

                </div>

                {!! Form::close() !!}

        </div>
    </div>
    <!-- END Page Content -->
@endsection




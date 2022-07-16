@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
@endsection

@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    @livewireStyles
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        ALL SWAP TEAMS
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">DataTable</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Teams
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    @can('is_superAdmin')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded row">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    teams ({{ $count }})
                </h3>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary rounded mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-plus "></i>
                </button>
                <a href="{{route('teams.archive')}}">
                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Archive">
                        <i class="fa fa-archive "></i>
                    </button>
                </a>
            </div>
            <!-- Modal -->
            {!! Form::open(['method'=>'CREATE', 'action'=>['App\Http\Controllers\AdminTeamsController@store'],
            'files'=>false]) !!}
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Company</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-4">
                                <div class="form-group mb-4">
                                    {!! Form::label('one-profile-edit-email', 'Name:', ['class'=>'form-label']) !!}
                                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                                    @error('name')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('one-profile-edit-email', 'VAT:', ['class'=>'form-label']) !!}
                                    {!! Form::text('VAT',null,['class'=>'form-control']) !!}
                                    @error('VAT')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('one-profile-edit-email', 'Phone:', ['class'=>'form-label']) !!}
                                    {!! Form::text('phone',null,['class'=>'form-control']) !!}
                                    @error('phone')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('one-profile-edit-email', 'Street:', ['class'=>'form-label']) !!}
                                    {!! Form::text('street',null,['class'=>'form-control']) !!}
                                    @error('street')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('one-profile-edit-email', 'Number:', ['class'=>'form-label']) !!}
                                    {!! Form::text('number',null,['class'=>'form-control']) !!}
                                    @error('number')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('one-profile-edit-email', 'Zip:', ['class'=>'form-label']) !!}
                                    {!! Form::text('zip',null,['class'=>'form-control']) !!}
                                    @error('zip')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('one-profile-edit-email', 'City:', ['class'=>'form-label']) !!}
                                    {!! Form::text('city',null,['class'=>'form-control']) !!}
                                    @error('city')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('one-profile-edit-email', 'Country:', ['class'=>'form-label']) !!}
                                    {!! Form::text('country',null,['class'=>'form-control']) !!}
                                    @error('country')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('one-profile-edit-email', 'Description:', ['class'=>'form-label']) !!}
                                    {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                                    @error('description')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="d-flex flex-column mt-4">
                                    {!! Form::label('ambassador','Ambassador:', ['class'=>'form-label']) !!}
                                    {!! Form::select('ambassador',$ambassadors,null,['class'=>'form-control', 'placeholder' => 'Select if applicable...'])!!}
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
        </div>
        {!! Form::close() !!}
        <!-- END Modal -->

            <div class="block-content block-content-full overflow-scroll">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                @livewire('teams')
            </div>
        </div>
        <!-- END Dynamic Table Full -->
        @livewireScripts
    </div>
    <!-- END Page Content -->
    @endcan
@endsection

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
                        Card generator
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">DataTable</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            List
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded row">
            <div class="block-content block-content-full overflow-scroll">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <div>
                    <table class="table table-striped table-hover table-vcenter fs-sm">
                        <thead>
                        <tr>
                            <th scope="col">#Card ID</th>
                            <th scope="col">Card URL</th>
                            @if($QRcode->status == 1)
                                <th scope="col">QRCODE URL</th>
                            @endif
                            <th scope="col">Package</th>
                            <th scope="col">Material</th>
                            <th scope="col">Member</th>
                            <th scope="col">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($urls)
                            @foreach($urls as $url)
                                <tr>
                                    <td>{{$url->id ? $url->id : 'No ID'}}</td>
                                    <td>{{$url->memberURL ? $url->memberURL : ""}}</td>
                                    @if($QRcode->status == 1)
                                        @if($url->custom_QR_url != "")
                                            <td>
                                                <span class="rounded-pill p-2 btn-success">CUSTOM</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="rounded-pill p-2 btn-primary">vCard</span>
                                            </td>
                                        @endif
                                    @endif
                                    <td>{{$url->package ? $url->package->package : "No Package" }}</td>
                                    <td>{{$url->material ? $url->material->name : "No Material" }}</td>
                                    @if($url->member)
                                        @if($url->member->user->archived == 1)
                                            <td><span class="rounded-pill btn-alt-warning p-2">archived</span></td>
                                        @else
                                            <td>{{$url->member ? $url->member->lastname : "not-active" }} {{ $url->member ? $url->member->firstname : "" }}</td>
                                        @endif
                                    @else
                                        <td>{{$url->member ? $url->member->lastname : "not-active" }} {{ $url->member ? $url->member->firstname : "" }}</td>
                                    @endif
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$url->id}}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$url->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"># CARD ID {{ $url->id }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@updateMembersList', $url->id],
                                                               'files'=>false]) !!}
                                                        <div class="form-group mb-4">
                                                            <div class="d-flex flex-column mt-4">
                                                                {!! Form::label('loyal','Select Package:', ['class'=>'form-label']) !!}
                                                                {!! Form::select('package_id',$packages,$url->package->id,['class'=>'form-control'])!!}
                                                                {!! Form::hidden('url_id',$url->id)!!}
                                                            </div>
                                                            <div class="d-flex flex-column mt-4">
                                                                {!! Form::label('loyal','Select Material:', ['class'=>'form-label']) !!}
                                                                {!! Form::select('material_id',$materials,$url->material->id,['class'=>'form-control'])!!}
                                                            </div>
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
                                                                        <input class="form-control" type="text" value="{{ $url->custom_QR_url }}" name="input_QR_url">
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                        {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $urls->links()  !!}
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection




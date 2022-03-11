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
                @canany(['is_superAdmin', 'is_admin'])
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Members
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">DataTable</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Members
                        </li>
                    </ol>
                </nav>
                @endcanany
                @can('is_client')
                    <div class="flex-grow-1">
                        <h1 class="h3 fw-bold mb-2">
                            Account
                        </h1>
                    </div>
                    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="javascript:void(0)">DataTable</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                settings
                            </li>
                        </ol>
                    </nav>
                @endcan
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content container-fluid">
        @can('is_superAdmin')
            <div class="mb-3">
{{--                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                    Member <i class="ms-2 far fa-user"></i>--}}
{{--                </a>--}}
{{--                @if($QRcode->status != 1)--}}
{{--                    <a href="{{ route('members.listGenerator') }}" class="btn btn-alt-success">EXCEL<i class="far fa-file-excel ms-2"></i></a>--}}
{{--                @endif--}}
{{--                @if($QRcode->status == 1)--}}
{{--                    <a href="{{ route('QRcodeListCustom') }}" class="btn btn-alt-warning">QRcode<i class="fa fa-list-ul ms-2"></i></a>--}}
{{--                @endif--}}
            </div>
            <div class="collapse mb-5" id="collapseExample">
                <div class="card card-body">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3> Members Generator</h3>
                        </div>
                        <div class="block-content block-content-full overflow-scroll">
                            <form class="col-4 mb-0" name="contactformulier"
                                  action="{{action('App\Http\Controllers\AdminMembersController@generate')}}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <input type="number" class="form-control" name="member_number"
                                           placeholder="Enter your number" style="width: 120px">
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-alt-primary">
                                        <i class="fa fa-paper-plane me-1 opacity-50"></i> Generate
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

            @livewire('members')

        @livewireScripts
    </div>
    <!-- END Page Content -->
@endsection




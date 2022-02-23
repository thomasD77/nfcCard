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
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content container-fluid">
{{--        @can('is_superAdmin')--}}
{{--            <div class="mb-3">--}}
{{--                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                    Member Generator--}}
{{--                </a>--}}
{{--                <a class="btn btn-secondary" data-bs-toggle="collapse" href="#collapseExampleList" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                    URL Generator--}}
{{--                </a>--}}
{{--                <a class="btn btn-alt-warning" data-bs-toggle="collapse" href="#collapseExampleQRcode" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                    QRcode Generator--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="collapse mb-5" id="collapseExample">--}}
{{--                <div class="card card-body">--}}
{{--                    <div class="block block-rounded">--}}
{{--                        <div class="block-header block-header-default">--}}
{{--                            <h3>Members Generator</h3>--}}
{{--                        </div>--}}
{{--                        <div class="block-content block-content-full overflow-scroll">--}}
{{--                            <form class="col-4 mb-0" name="contactformulier"--}}
{{--                                  action="{{action('App\Http\Controllers\AdminMembersController@generate')}}" method="post">--}}
{{--                                @csrf--}}
{{--                                <div class="mb-4">--}}

{{--                                    <input type="number" class="form-control" name="member_number"--}}
{{--                                           placeholder="Enter your number">--}}
{{--                                </div>--}}
{{--                                <div class="mb-4">--}}
{{--                                    <button type="submit" class="btn btn-alt-primary">--}}
{{--                                        <i class="fa fa-paper-plane me-1 opacity-50"></i> Generate--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="collapse mb-5" id="collapseExampleList">--}}
{{--                <div class="card card-body">--}}
{{--                    <div class="block block-rounded">--}}
{{--                        <div class="block-header block-header-default">--}}
{{--                            <h3>URL List Generator</h3>--}}
{{--                        </div>--}}
{{--                        <div class="block-header block-header-default">--}}
{{--                            <div class="d-flex flex-column">--}}
{{--                                <p>!!! Important to add the "https://" </p>--}}
{{--                                <p>!!! Important NO "/" in the END </p>--}}
{{--                                @if($member->memberURL != "")--}}
{{--                                    <p>Current url is: {{ $member_url }}</p>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                        </div>--}}
{{--                        <div class="block-content block-content-full overflow-scroll">--}}
{{--                            <form class="col-6 mb-0" name="contactformulier"--}}
{{--                                  action="{{action('App\Http\Controllers\CardController@listGenerator')}}" method="post">--}}
{{--                                @csrf--}}
{{--                                <div class="mb-4">--}}
{{--                                    <input type="text" class="form-control" name="member_url"--}}
{{--                                           placeholder="Enter your url">--}}
{{--                                </div>--}}
{{--                                <div class="form-check mt-5">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="1" name="Excel" id="flexCheckDefault">--}}
{{--                                    <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                        Generate urls and print Excel file (choose here:)--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="1" name="landingpageDefault" id="flexCheckDefault">--}}
{{--                                    <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                        Landingpage (default)--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="1" name="landingpageCustom" id="flexCheckDefault">--}}
{{--                                    <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                        Landingpage (custom)--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check mb-2">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="1" name="vCard" id="flexCheckChecked">--}}
{{--                                    <label class="form-check-label" for="flexCheckChecked">--}}
{{--                                        vCard--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="1" name="QRcode" id="flexCheckDefault">--}}
{{--                                    <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                       QR-code--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="my-4">--}}
{{--                                    <button type="submit" class="btn btn-alt-primary">--}}
{{--                                        <i class="fa fa-paper-plane me-1 opacity-50"></i> Generate--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="collapse mb-5" id="collapseExampleQRcode">--}}
{{--                <div class="card card-body">--}}
{{--                    <div class="block block-rounded">--}}
{{--                        <div class="block-header block-header-default">--}}
{{--                            <h3>QRcode page generator</h3>--}}
{{--                        </div>--}}
{{--                        <div class="block-content block-content-full overflow-scroll">--}}
{{--                            <form class="col-6 mb-0" name="contactformulier"--}}
{{--                                  action="{{action('App\Http\Controllers\QRcodeController@QRcodeListWithParams')}}" target="_blank" method="post">--}}
{{--                                @csrf--}}

{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="1" name="landingpageDefault" id="flexCheckDefault">--}}
{{--                                    <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                        Landingpage (default)--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="1" name="landingpageCustom" id="flexCheckDefault">--}}
{{--                                    <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                        Landingpage (custom)--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check mb-2">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="1" name="vCard" id="flexCheckChecked">--}}
{{--                                    <label class="form-check-label" for="flexCheckChecked">--}}
{{--                                        vCard--}}
{{--                                    </label>--}}
{{--                                </div>--}}

{{--                                <div class="my-4">--}}
{{--                                    <button type="submit" class="btn btn-alt-primary">--}}
{{--                                        <i class="fa fa-paper-plane me-1 opacity-50"></i> Generate--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endcan--}}

        <!-- Dynamic Table Full -->
        <div class="block block-rounded row">
            <div class="block-header block-header-default d-flex justify-content-between">
                <!-- Search Form (visible on larger screens) -->
                <form class="d-none d-md-inline-block" action="{{action('App\Http\Controllers\AdminMembersController@searchMember')}}" method="POST">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="member">
                        <span class="input-group-text border-0"><button class="border border-0" type="submit"><i class="fa fa-fw fa-search"></i></button></span>
                    </div>
                </form>
                <!-- END Search Form -->
                <a href="{{route('members.index')}}">
                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Back to List">
                        <i class="far fa-list-alt "></i>
                    </button>
                </a>
            </div>
            <div class="block-content block-content-full overflow-scroll">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <div>
                    <table class="table table-striped table-hover table-vcenter fs-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            @canany(['is_superAdmin', 'is_admin'])
                                <th scope="col">role</th>
                            @endcanany
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($members)
                            @foreach($members as $member)
                                @if($active_user_role == 'client')
                                    @if($active_user == $member->user_id)
                                        <tr>
                                            <td>{{$member->id ? $member->id : 'No ID'}}</td>
                                            <td>{{$member->lastname ? $member->lastname : 'MEMBER' . $member->id}} {{ $member->firstname ? $member->firstname : '' }}</td>
                                            <td>{{$member->email ? $member->email : 'MEMBER-' . $member->id}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('members.edit', $member->id)}}">
                                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('members.show', $member->id)}}">
                                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                                            <i class="far fa-eye"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td>{{$member->id ? $member->id : 'No ID'}}</td>
                                        <td>{{$member->lastname ? $member->lastname : 'MEMBER-' . $member->id}} {{ $member->firstname ? $member->firstname : '' }}</td>
                                        <td>{{$member->email ? $member->email : 'MEMBER-' . $member->id}}</td>
                                        <td>{{$member->user ? $member->user->roles->first()->name : 'MEMBER' . $member->id}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('members.edit', $member->id)}}">
                                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </button>
                                                </a>
                                                <a href="{{route('members.landingpageDefault', $member->id)}}">
                                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                                        <i class="far fa-eye"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $members->links()  !!}
                </div>

            </div>
        </div>
        <!-- END Dynamic Table Full -->
        @livewireScripts
    </div>
    <!-- END Page Content -->
@endsection




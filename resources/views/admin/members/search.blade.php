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
        <!-- Dynamic Table Full -->
        <div class="block block-rounded row">
            <div class="block-header block-header-default d-flex justify-content-between">
                <!-- Search Form (visible on larger screens) -->
                <form class="d-none d-md-inline-block" action="{{action('App\Http\Controllers\AdminMembersController@searchMember')}}" method="POST">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-alt w-50" style="width: 50%" placeholder="Search for name..." id="page-header-search-input2" name="member">
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
                            <th scope="col">user account</th>
                            <th scope="col">role</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($members)
                            @foreach($members as $member)
                                <tr>
                                    <td>{{$member->id ? $member->id : 'No ID'}}</td>
                                    <td>{{$member->lastname ? $member->lastname : ''}} {{ $member->firstname ? $member->firstname : '' }}</td>
                                    <td>{{$member->email ? $member->email : 'unknown'}}</td>
                                    <td>{{$member->user ? $member->user->name : 'unknown'}}</td>
                                    <td>{{$member->user ? $member->user->roles->first()->name : 'No Role'}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('members.edit', $member->id)}}">
                                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('direction', $member->id)}}">
                                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
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




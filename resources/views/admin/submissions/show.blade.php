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
@endsection

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Submission
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        credentials
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Contact</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Current
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Submission Profile</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            This is vital account info. Please don't share this information.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group my-5">
                            <label class="form-label mb-2">Name</label>
                            <p class="border border-1 border border-light rounded w-100 p-2">{{$submission->name}}</p>
                        </div>
                        <div class="form-group my-5">
                            <label class="form-label mb-2">Phone</label>
                            <p class="border border-1 border border-light rounded w-100 p-2 mb-0">{{$submission->phone}}</p>
                        </div>
                        <div class="form-group my-5">
                            <label class="form-label mb-2">E-mail</label>
                            <p class="border border-1 border border-light rounded w-100 p-2 mb-0">{{$submission->email}}</p>
                        </div>
                        <div class="form-group my-5">
                            <label class="form-label mb-2">Registered</label>
                            <p class="border border-1 border border-light rounded w-100 p-2 mb-0">{{$submission->created_at->diffForHumans()}}</p>
                        </div>
                        <div class="form-group my-5 d-flex flex-column">
                            <label class="form-label mb-2">Terms & Conditions</label>
                            <div>
                                @if($submission->approval == 1)
                                    <p class="rounded-pill badge bg-success text-white p-3 mb-0">Approved</p>
                                @else
                                    <p class="rounded-pill badge bg-danger p-3 mb-0">Not Approved</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group my-5">
                            <label class="form-label mb-2">Date Appointment</label>
                            <p class="border border-1 border border-light rounded w-100 p-2 mb-0">{{$submission->date}}</p>
                        </div>
                        <div class="form-group my-5">
                            <label class="form-label mb-2">Customer situation description</label>
                            <p class="border border-1 border border-light rounded w-100 p-2 mb-0">{{$submission->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END User Profile -->
    </div>
    <!-- END Page Content -->
@endsection

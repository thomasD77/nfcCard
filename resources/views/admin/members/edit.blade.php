@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
@endsection

@section('js_after')

@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Edit Profile
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">DataTable</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    @can('is_member', $member)
    <!-- Page Content -->
    <div class="content content-boxed px-0">

        <!-- Page Content -->
        <div class="content content-boxed">
            <!-- member Profile -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Member Profile</h3>
                </div>
                @if($member->user->archived == 0)

                    @if($member->package->package == 'vCard')
                        @include('admin.members.includes.vCard')

                    @elseif($member->package->package == 'Default')
                        @include('admin.members.includes.default')

                    @elseif($member->package->package == "Custom")
                        @include('admin.members.includes.custom')
                    @endif

                @else
                    <p class="p-2">Sorry, the admin blocked your account. Please contact him for this situation.</p>
                @endif
            </div>
            <!-- END member Profile -->
        </div>

    <!-- END Page Content -->
    @endcan

@endsection




@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        ALL SWAP USERS
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ asset('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Users
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
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Users ({{ $count }})
                </h3>
                <a href="{{route('users.archive')}}">
                    @canany(['is_superAdmin', 'is_admin'])
                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Archive">
                        <i class="fa fa-archive "></i>
                    </button>
                    @endcanany
                </a>
            </div>
            <div class="block-content block-content-full overflow-scroll">
                @livewire('users')
            </div>
        </div>
        <!-- END Dynamic Table Full -->
        @livewireScripts
    </div>
    <!-- END Page Content -->
@endsection

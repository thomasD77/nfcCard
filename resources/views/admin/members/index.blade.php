@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                @canany(['is_superAdmin', 'is_admin'])
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        ALL SWAP MEMBERS
                    </h1>
                    <p class="text-muted">A clear overview from all your Swap team members.</p>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ asset('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Members
                        </li>
                    </ol>
                </nav>
                @endcanany

            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content container-fluid">

        @livewire('members')

    </div>
    <!-- END Page Content -->
@endsection




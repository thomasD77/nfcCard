@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Your digital identity
                    </h1>
                    <p class="text-muted">This is your personal QR-code. When you share these with other people they will be sent directly to your profile page.</p>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ asset('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            QR-CODE
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="card shadow my-5 p-3" style="border: none">
                    <div class="card-body">
                        {{$QRcode}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection




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
                    <p class="text-muted">Easily share your personal link from your profile with other people by copying it here</p>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">DataTable</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Your link
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content container-fluid my-5">
        <div class="row">
            <div>
                Click here >>
                <button class="btn btn-secondary mb-3"
                        data-href="{{Auth()->user()->member->memberURL}}"
                        id="to-clipboard">
                    <i class="far fa-copy"></i>
                </button>
                <div class="alert-success p-2">Copied to clipboard!</div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection




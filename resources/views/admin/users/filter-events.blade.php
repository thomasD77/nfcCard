@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    YOUR EVENTS
                </h1>
                <p class="text-muted">Here you can create/update all your events</p>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ asset('/admin') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        Events
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
                @livewire('events-contact')
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
<!-- END Page Content -->
@endsection

<?php
use App\Models\ServiceCategory;
?>
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
                        Services
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">DataTable</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Services
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
                    Services
                </h3>
                <a href="{{route('services.create')}}"><button data-bs-toggle="tooltip" title="New Service" class="btn btn-alt-primary"><i class="fa fa-plus"></i></button></a>
                <a href="{{route('services.archive')}}">
                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Archive">
                        <i class="fa fa-archive "></i>
                    </button>
                </a>
            </div>
            <div class="block-content block-content-full overflow-scroll">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <div>

                    @php
                    $categories = ServiceCategory::all();
                    $count = $categories->count();
                    $x = 0;
                    @endphp

                    @for($i = 0; $i < $count; $i++)
                        <h2>{{ $categories[$x]['name'] }}</h2>
                        <table class="table table-striped table-hover table-vcenter fs-sm my-5 py-5">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Registered</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($services)
                                @foreach($services as $service)
                                    @if($service->servicecategory == $categories[$x])
                                        <tr>
                                            <td>{{$service->id ? $service->id : 'No ID'}}</td>
                                            <td>{{$service->name ? $service->name : 'No Name'}}</td>
                                            <td>{{$service->servicecategory ? $service->servicecategory->name : 'No Category'}}</td>
                                            <td>{{$service->created_at ? $service->created_at->diffForHumans() : 'Not Verified'}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{route('services.edit', $service->id)}}">
                                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit service">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                    </a>
                                                    <button class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Archive service" wire:click="archiveService({{$service->id}})"><i class="fa fa-archive"></i></button>
                                                    <a href="{{route('services.show', $service->id)}}">
                                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show service">
                                                            <i class="far fa-eye"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif

                            <?php $x++ ?>

                            </tbody>
                        </table>
                    @endfor
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->

        @livewireScripts
    </div>
    <!-- END Page Content -->
@endsection




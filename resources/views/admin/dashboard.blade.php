@extends('layouts.backend')

@section('content')

    <style>
        .parent {
            position: relative;
        }
        #flash_message {
            position: absolute;
            top: -5px;
            right: -5px;
            opacity: 0.9;
            color: white;
        }

        #flash_message:hover{
            transform: scale(1.1);
            opacity: 1.1;
        }
    </style>

    @can('is_superAdmin')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex parent flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Dashboard
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Welcome {{Auth::user()->name}}, everything looks great,
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">App</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </nav>
                <div style="z-index: 99" id="flash_message">
                    @if(Session::has('flash_message'))
                        <p style="z-index: 5" class="alert bg-success my-2">{{session('flash_message')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row row-deck mb-5 d-flex justify-content-center">
            <img class="rounded shadow px-0" style="width: 70%" src="{{ asset('images/content/handshake.jpg') }}" alt="bg-image">
        </div>
    </div>
    <!-- END Page Content -->
    @endcan

    @can('is_client')
        <div class="block block-rounded row">
            <div class="block-content block-content-full overflow-scroll">

                @if($member->user->archived == 0)

                    @include('admin.includes.flash')

                    <div class="parent">

                        <div class="card">
                            <div class="d-flex justify-content-center my-2">
                                <img class="rounded-circle" height=85 width="85" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}">

                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $member->firstname }} {{ $member->lastname }}</h5>
                                <p>{{ $member->email }}</p>
                                <p>{{ $member->company }}</p>
                                <p>{{ $member->jobTitle }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('members.edit', $member->id)}}">
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit profile">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                </a>
                                <a href="{{route('direction', $member->card_id)}}" target="_blank">
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show page">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="card-footer">
                                <strong class="mx-2">Your referral code:</strong><span class="badge badge-pill p-2 bg-success">{{ $member->referral }}</span>
                            </div>
                        </div>

                    </div>

                @else

                    <p class="p-2">Sorry, the admin blocked your account. Please contact him for this situation.</p>

                @endif

            </div>
        </div>
    @endcan






@endsection

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

    @canany([ 'is_superAdmin', 'is_admin'])
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex parent flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Dashboard
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Welcome {{Auth::user()->name}}, everything looks great!
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

            @can('is_superAdmin')
            <div class="row">
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="block block-rounded block-themed shadow">
                        <div class="block-header bg-default-dark">
                            <h3 class="block-title">swap scans</h3>
                            <div class="block-options">
                                <a href="{{route('contacts.index')}}" class="text-white">
                                    <i class="si si-settings"></i>
                                </a>
                            </div>
                        </div>
                        <div class="block-content">
                            <h5><strong>{{ $scans }}</strong></h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="block block-rounded block-themed shadow">
                        <div class="block-header bg-default-dark">
                            <h3 class="block-title">swap Users</h3>
                            <div class="block-options">
                                <a href="{{route('users.index')}}" class="text-white">
                                    <i class="si si-settings"></i>
                                </a>
                            </div>
                        </div>
                        <div class="block-content">
                            <h5><strong>{{ $users }}</strong></h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="block block-rounded block-themed shadow">
                        <div class="block-header bg-default-dark">
                            <h3 class="block-title">swap companies</h3>
                            <div class="block-options">
                                <a href="{{route('teams.index')}}" class="text-white">
                                    <i class="si si-settings"></i>
                                </a>
                            </div>
                        </div>
                        <div class="block-content">
                            <h5><strong>{{ $teams }}</strong></h5>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            <img class="rounded shadow px-0" style="width: 70%" src="{{ asset('images/content/handshake.jpg') }}" alt="bg-image">
        </div>
    </div>
    <!-- END Page Content -->
    @endcanany

    @can('is_client')
        <div class="block block-rounded row"
             style="background-image: url('images/content/handshake.jpeg');
             background-repeat: no-repeat;
             height: 100%; width: 100%;
             background-position: center;
             background-size: cover">
            <div class="block-content block-content-full ">

                @if($member->user->archived == 0)

                    @include('admin.includes.flash')

                    <div class="parent">

                        <div class="card shadow pt-4 col-md-6 offset-md-3 p-md-4 my-md-5" style="border: none">


                            <div class="d-flex justify-content-center m-2">
                                <img class="rounded-circle" width="150" height="150" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}">
                            </div>

                            <div class="card-body">
                                <h4 class="card-title mb-4">{{ $member->firstname }} {{ $member->lastname }}</h4>
                                @if($member->email)
                                    <div class="row">
                                        <i class="far fa-envelope col-1 pt-2"></i>
                                        <p class="col-10">{{ $member->email }}</p>
                                    </div>
                                @endif

                                @if($member->company)
                                    <div class="row">
                                        <i class="far fa-building col-1 pt-2"></i>
                                        <p class="col-10">{{ $member->company }}</p>
                                    </div>
                                @endif

                                @if($member->jobTitle)
                                    <div class="row">
                                        <i class="far fa-building col-1 pt-2"></i>
                                        <p class="col-10">{{ $member->jobTitle }}</p>
                                    </div>
                                @endif

                            </div>

                            <div class="row px-2">
                                <a href="{{route('contacts.index')}}" class="bg-light">
                                    <div class="row py-3">
                                        <div class="col-4">
                                            <i class="far fa-comments text-dark" style="font-size: 45px"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <p class="fw-semibold mb-0">SWAPS</p>
                                            <span class="text-muted" style="font-size: 12px">Check your SWAPS here</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="row px-2">
                                <a href="{{route('members.edit', $member->id)}}">
                                    <div class="row py-3">
                                        <div class="col-4">
                                            <i class="fa fa-fw fa-pencil-alt text-dark" style="font-size: 45px"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <p class="fw-semibold mb-0">Edit profile</p>
                                            <span class="text-muted" style="font-size: 12px">click here to set up your profile</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="row px-2">
                                <a href="{{route('direction', $member->card_id)}}" class="bg-light">
                                    <div class="row py-3">
                                        <div class="col-4">
                                            <i class="far fa-eye text-dark" style="font-size: 45px"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <p class="fw-semibold mb-0">Show profile</p>
                                            <span class="text-muted" style="font-size: 12px">click here to view your profile</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="row px-2">
                                <a href="{{route('show.QRcode', Auth()->user()->member->card_id)}}">
                                    <div class="row py-3">
                                        <div class="col-4">
                                            <i class="fa fa-qrcode text-dark" style="font-size: 45px"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <p class="fw-semibold mb-0">QRcode</p>
                                            <span class="text-muted" style="font-size: 12px">Scan your QRcode here</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="row px-2">
                                <a href="{{route('settings')}}" class="bg-light">
                                    <div class="row py-3">
                                        <div class="col-4">
                                            <i class="si si-settings text-dark" style="font-size: 45px"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <p class="fw-semibold mb-0">Settings</p>
                                            <span class="text-muted" style="font-size: 12px">Check your settings here</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="card-footer bg-dark">
                                <span class="mx-2 text-white">Your referral code:</span><span class="badge badge-pill p-2"><strong>{{ $member->referral }}</strong></span>
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

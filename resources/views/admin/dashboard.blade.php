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
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row row-deck mb-5 d-flex justify-content-center">
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
            <img class="rounded shadow px-0" style="width: 70%" src="{{ asset('images/content/handshake.jpg') }}" alt="bg-image">
        </div>
    </div>
    <!-- END Page Content -->
    @endcan

    @canany([ 'is_client', 'is_admin'])
        @if(!Auth()->user()->is_company)
        <div class="row parent"
            style="background-image: url('images/content/background_4.png');
            background-repeat: no-repeat;
            height: 100%; width: 100%;
            background-position: center center;
            background-size: cover">
        @else
        <div class="row parent"
            style="background-image: url('images/content/bg.jpeg');
            background-repeat: no-repeat;
            height: 100%; width: 100%;
            background-position: center center;
            background-size: cover">
        @endif



            <div class="block-content mb-4" style="padding-left: 27px;">


                        @include('admin.includes.flash')

                        <div class="card shadow pt-4 col-md-6 offset-md-3 p-md-4 my-md-3" style="border: none; background-color: rgba(255,255,255,0.87)">

                            @if(Auth::user()->member)
                                @if(isset(Auth::user()->member->listurl))
                                    @if(Auth::user()->member->listurl->type_id == 8 )
                                        <div class="card-header bg-dark">
                                            <p class="text-white mb-0">This is a SWAP TEST card. </p>
                                            <p class="text-white">You can use this card until:  <strong>{{ $member->listurl->trial_date }}</strong> </p>
                                        </div>
                                    @endif
                                @endif
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">

                                        @if(Auth()->user()->is_company)
                                            <h4 class="card-title mb-4">{{ $member->company }}</h4>
                                        @else
                                            <h4 class="card-title mb-4">{{ $member->firstname }} {{ $member->lastname }}</h4>
                                        @endif



                                        @if($member->email)
                                            <div class="row">
                                                <i class="far fa-envelope col-1 pt-2"></i>
                                                <p class="col-10">{{ $member->email }}</p>
                                            </div>
                                        @endif

                                        @if(!Auth()->user()->is_company)
                                            @if($member->company)
                                                <div class="row">
                                                    <i class="far fa-building col-1 pt-2"></i>
                                                    <p class="col-10">{{ $member->company }}</p>
                                                </div>
                                            @endif
                                        @endif

                                        @if($member->jobTitle)
                                            <div class="row">
                                                <i class="far fa-compass col-1 pt-2"></i>
                                                <p class="col-10">{{ $member->jobTitle }}</p>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center mb-5 my-md-4">
                                    <img class="rounded-circle" width="150" height="150" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}">
                                </div>
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
                               @if($member->card_id !== 0)
                                    <a href="{{route('direction', $member->card_id)}}" target="_blank" class="bg-light">
                                @else
                                    <a href="{{route('direction.test', $member)}}" target="_blank" class="bg-light">
                                @endif
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
                                <a href="{{route('stats')}}">
                                    <div class="row py-3">
                                        <div class="col-4">
                                            <i class="fa fa-chart-line text-dark" style="font-size: 45px"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <p class="fw-semibold mb-0">Your numbers</p>
                                            <span class="text-muted" style="font-size: 12px">click here to view your data/statistics</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            @if($member->card_id !== 0)
                            <div class="row px-2">
                                <a href="{{route('show.QRcode', Auth()->user()->member->card_id)}}}" class="bg-light">
                                    <div class="row py-3">
                                        <div class="col-4">
                                            <i class="fa fa-qrcode text-dark" style="font-size: 45px"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <p class="fw-semibold mb-0">QR-code</p>
                                            <span class="text-muted" style="font-size: 12px">Scan your Qr-code here</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            <div class="row px-2">
                                <a href="{{route('settings')}}">
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

                            <div class="row px-2">
                                <div class="card-footer bg-secondary">
                                    <span class="text-white">Your card ID:</span><span class="badge badge-pill p-2"><strong>#{{ $member->card_id }}</strong></span>
                                </div>

                                <div class="card-footer bg-dark">
                                    <span class="text-white">Your referral code:</span><span class="badge badge-pill p-2"><strong>{{ $member->referral }}</strong></span>
                                </div>
                            </div>

                        </div>

            </div>
        </div>

    @endcanany
@endsection

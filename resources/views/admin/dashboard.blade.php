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
        <div class="row row-deck">

            <!-- START STAP 3 -->
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">STAP 3: How many Cards? </h3>
                        @if($lock->status == 1)
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseCards" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-arrow-down"></i>
                            </a>
                        @endif
                    </div>
                    <div class="block-content fs-sm text-muted pt-0">
                        <div class="collapse" id="collapseCards">
                            <div class="card card-body border border-0 pt-0">
                                <form class="col-6 mb-0" name="contactformulier"
                                      action="{{action('App\Http\Controllers\Dashboard\CardListGenerator@generateListUrl')}}" method="post">
                                    @csrf
                                    <div class="form-check my-4 px-0">
                                        <label class="form-check-label mb-1">
                                            Set your Card number
                                        </label>
                                        <input class="form-control" type="number" name="card_number" value="card_number">
                                    </div>
                                    <!-- Button trigger modal -->
                                    <button type="submit" class="btn btn-alt-primary">
                                        <i class="fa fa-paper-plane me-1 opacity-50"></i> Generate
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="py-2">
                            <p style="font-weight: bold">Current Cards: </p>
                            <p> {{ $total_cards }} </p>
                            @if(Session::has('negative_number'))
                                <p class="alert alert-danger my-2">{{session('negative_number')}}</p>
                            @endif
                        </div>
                        @if($total_custom > 0)
                            <div class="py-2">
                                <p style="font-weight: bold">Custom Package(s): </p>
                                <p > {{ $total_custom }} </p>
                            </div>
                        @endif
                        @if($total_default > 0)
                            <div class="py-2">
                                <p style="font-weight: bold">Default Package(s): </p>
                                <p> {{ $total_default }} </p>
                            </div>
                        @endif
                        @if($total_vCard > 0 )
                            <div class="py-2">
                                <p style="font-weight: bold">vCard Package(s): </p>
                                <p> {{ $total_vCard }} </p>
                            </div>
                        @endif
                        @if($total_pvc > 0 )
                            <div class="py-2">
                                <p style="font-weight: bold">PVC Card(s): </p>
                                <p> {{ $total_pvc }} </p>
                            </div>
                        @endif
                        @if($total_metal > 0 )
                            <div class="py-2">
                                <p style="font-weight: bold">Metal Card(s): </p>
                                <p> {{ $total_metal }} </p>
                            </div>
                        @endif
                        @if($total_wood > 0 )
                            <div class="py-2">
                                <p style="font-weight: bold">Wood Card(s): </p>
                                <p> {{ $total_wood }} </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END STAP 3 -->


            <!-- START STAP 4 -->
            @if($total_cards > 0)
                <div class="col-md-4 col-xl-4">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">STAP 4: Sheet Generator </h3>
                        </div>
                        <div class="block-content fs-sm text-muted pt-0">
                            <div class="py-4">
                                @if($QRcode->status != 1)
                                    <a href="{{ route('sheetGenerator') }}" class="btn btn-alt-success">EXCEL<i class="far fa-file-excel ms-2"></i></a>
                                @endif
                                @if($QRcode->status == 1)
                                    <a href="{{ route('sheet.QRcode') }}" class="btn btn-alt-warning">QRcode<i class="fa fa-list-ul ms-2"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- END STAP 4 -->

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

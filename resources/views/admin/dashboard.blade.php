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
    @canany(['is_superAdmin', 'is_admin'])

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
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Welcome</h3>
                    </div>
                    <div class="block-content fs-sm text-muted ">
                        <p style="font-weight: bold">Card status: </p>
                        @if($lock->status == 1)
                            <a href="{{ route('lock') }}"><button class="btn btn-success"><i class="fa fa-unlock"></i></button></a>
                        @else
                            <a href="{{ route('unlock') }}"><button class="btn btn-danger"><i class="fa fa-lock"></i></button></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">STAP 1: OUR URL</h3>
                    </div>
                    <div class="block-content fs-sm text-muted">
                        <p style="font-weight: bold">
                            Current URL:
                        </p>
                        <p>
                            {{ $currentURL->url }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">STAP 2: QRcode</h3>
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseQR" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-arrow-down"></i>
                        </a>
                    </div>
                    <div class="block-content fs-sm text-muted">
                        <div class="collapse" id="collapseQR">
                            <div class="card card-body border border-0">
                                <form class="col-6 mb-0" name="contactformulier"
                                      action="{{action('App\Http\Controllers\QRcodeController@QRcodeSelect')}}" method="post">
                                    @csrf
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="ja" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Ja
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="nee" name="flexRadioDefault" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Nee
                                        </label>
                                    </div>
                                    <div class="my-4">
                                        <button type="submit" class="btn btn-alt-primary">
                                            <i class="fa fa-paper-plane me-1 opacity-50"></i> Choose
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <p style="font-weight: bold">QRcode status: </p>
                            @if($QRcode->status == 0)
                                <p>Nee</p>
                            @endif
                            @if($QRcode->status == 1)
                                <p>Ja</p>
                            @endif
                    </div>
                </div>
            </div>
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
                                      action="{{action('App\Http\Controllers\CardController@generateCards')}}" method="post">
                                    @csrf
                                    <div class="form-check my-4 px-0">
                                        <label class="form-check-label mb-1">
                                            Set your Card number
                                        </label>
                                        <input class="form-control" type="number" name="card_number" value="card_number">
                                    </div>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-alt-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-paper-plane me-1 opacity-50"></i> Generate
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>If you generate again all current card information will be lost.</p>

                                                    <button type="submit" class="btn btn-alt-primary">
                                                        <i class="fa fa-paper-plane me-1 opacity-50"></i> Generate
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="py-2">
                            <p style="font-weight: bold">Current Cards: </p>
                            <p> {{ $total_cards }} </p>
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
            @if($total_cards > 0)
                <div class="col-md-6 col-xl-4">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">STAP 4: List Generator </h3>
                        </div>
                        <div class="block-content fs-sm text-muted pt-0">
                            <div class="py-4">
                                @if($QRcode->status != 1)
                                    <a href="{{ route('members.listGenerator') }}" class="btn btn-alt-success">EXCEL<i class="far fa-file-excel ms-2"></i></a>
                                @endif
                                @if($QRcode->status == 1)
                                    <a href="{{ route('QRcodeListCustom') }}" class="btn btn-alt-warning">QRcode<i class="fa fa-list-ul ms-2"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- END Page Content -->
    @endcanany

    @can('is_client')
        <!-- Page Content -->
        <div class="content content-boxed">
            <!-- member Profile -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Member Profile</h3>
                    <div>
                        <p style="font-weight: bold">#Card ID: {{ $member->card_id }}</p>
                    </div>
                </div>
                @if($member->user->archived == 0)

                    @if($member->package->package == 'vCard')
                        @include('admin.members.includes.vCard')

                    @elseif($member->package->package == 'Default')
                        @include('admin.members.includes.default')

                    @elseif($member->package->package == "Custom")
                        @include('admin.members.includes.custom')

                    @endif
                @else
                    <p class="p-2">Sorry, the admin blocked your account. Please contact him for this situation.</p>
                @endif
            </div>
            <!-- END member Profile -->
        </div>
        <!-- END Page Content -->
    @endcan






@endsection

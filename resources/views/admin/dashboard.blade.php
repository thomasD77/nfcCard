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
                    <div class="block-content fs-sm text-muted">
                        <p>
                            We’ve put everything together, so you can start working on your Laravel project as soon as possible! OneUI assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.
                        </p>
                        <p>
                            Feel free to use any examples you like from the full HTML version to build your own pages.
                        </p>
                        <p>
                            <strong>Wish you all the best and happy coding!</strong>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Package</h3>
                    </div>
                    <div class="block-content fs-sm text-muted">
                        <form class="col-6 mb-0" name="contactformulier"
                              action="{{action('App\Http\Controllers\CardController@choosePackage')}}" method="post">
                            @csrf
                           <div class="form-check">
                                <input class="form-check-input" type="radio" value="vCard" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    vCard
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="custom" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Landingpage (custom)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="default" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Landingpage (default)
                                </label>
                            </div>
                            <div class="my-4">
                                <button type="submit" class="btn btn-alt-primary">
                                    <i class="fa fa-paper-plane me-1 opacity-50"></i> Choose
                                </button>
                            </div>
                        </form>
                        <p>Current package: {{ $package }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Logo</h3>
                        <h3 class="block-title">Logo</h3>
                    </div>
                    <div class="block-content d-flex justify-content-center align-items-center">
                        @if(isset($photos))
                            @php
                                $company = \App\Models\CompanyCredential::find(1);
                                if(isset($company)){
                                    $photo = \App\Models\Photo::where('credential_id', $company->id)->first();
                                }
                            @endphp
                            @if(isset($photo))
                                <input type="hidden" name="photo" value="{{$photo->id}}">
                                <img class="rounded mt-2" height="200" width="200" src="{{$photo ? asset('images/form_credentials') . $photo->file : 'http://placehold.it/62x62'}}" alt="{{$company ? $company->firstname : ""}}">
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

{{--    @canany(['is_admin', 'is_superAdmin', 'is_client'])--}}
{{--        @include('admin.includes.dash-blocks')--}}
{{--    @endcanany--}}




@endsection

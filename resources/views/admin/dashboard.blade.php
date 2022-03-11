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
                        <h3 class="block-title">STAP 2: Package</h3>
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-arrow-down"></i>
                        </a>
                    </div>
                    <div class="block-content fs-sm text-muted">
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body border border-0">
                                <form class="col-6 mb-0" name="contactformulier"
                                      action="{{action('App\Http\Controllers\CardController@choosePackage')}}" method="post">
                                    @csrf
                                    <div class="form-check my-4">
                                        <input class="form-check-input" type="radio" value="default" name="flexRadioDefault" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Landingpage (default)
                                        </label>
                                    </div>
                                    <div class="form-check my-4">
                                        <input class="form-check-input" type="radio" value="custom" name="flexRadioDefault" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Landingpage (custom)
                                        </label>
                                    </div>
                                    <div class="form-check my-4">
                                        <input class="form-check-input" type="radio" value="vCard" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            vCard
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

                        <p style="font-weight: bold">Current package: </p>
                        <p> {{ $package }} </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">STAP 3: QRcode</h3>
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
                        <h3 class="block-title">STAP 4: How many Cards? </h3>
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseCards" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-arrow-down"></i>
                        </a>
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
                                    <div class="my-4">
                                        <button type="submit" class="btn btn-alt-primary">
                                            <i class="fa fa-paper-plane me-1 opacity-50"></i> Generate
                                        </button>
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
                                <p> {{ $total_custom }} </p>
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
                            <h3 class="block-title">STAP 5: List Generator </h3>
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
                </div>

                @if($package == 'vCard')
                    <div class="block-content">
                        <div class="row push">
                            <div class="col-lg-2">
                                <p class="fs-sm text-muted">
                                    Here you can Update your Happy member.
                                </p>
                            </div>
                            <div class="col-lg-10">
                                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],
                                    'files'=>true])
                               !!}

                                <p>General</p>
                                <div class="form-group mb-4">
                                    {!! Form::label('firstname','firstname:',['class'=>'form-label']) !!}
                                    {!! Form::text('firstname',$member->firstname ,['class'=>'form-control']) !!}
                                    @error('firstname')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('lastname','Lastname:',['class'=>'form-label']) !!}
                                    {!! Form::text('lastname',$member->lastname ,['class'=>'form-control']) !!}
                                    @error('lastname')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                                    {!! Form::text('email',$member->email ,['class'=>'form-control']) !!}
                                    @error('email')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('company','Company:',['class'=>'form-label']) !!}
                                    {!! Form::text('company',$member->company ,['class'=>'form-control']) !!}
                                    @error('company')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('age','Age:',['class'=>'form-label']) !!}
                                    {!! Form::date('age',$member->age ,['class'=>'form-control']) !!}
                                    @error('age')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('jobTitle','Job title:',['class'=>'form-label']) !!}
                                    {!! Form::text('jobTitle',$member->jobTitle ,['class'=>'form-control']) !!}
                                    @error('jobTitle')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('website','Website (use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('website',$member->website ,['class'=>'form-control']) !!}
                                    @error('website')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('notes','Notes:',['class'=>'form-label']) !!}
                                    {!! Form::textarea('notes',$member->notes ,['class'=>'form-control']) !!}
                                    @error('notes')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('mobileWork','Mobile work:',['class'=>'form-label']) !!}
                                    {!! Form::text('mobileWork',$member->mobileWork ,['class'=>'form-control']) !!}
                                    @error('mobileWork')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                                    {!! Form::text('mobile',$member->mobile ,['class'=>'form-control']) !!}
                                    @error('mobile')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('addressLine1','Address Line 1:',['class'=>'form-label']) !!}
                                    {!! Form::text('addressLine1',$member->addressLine1 ,['class'=>'form-control']) !!}
                                    @error('addressLine1')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('addressLine2','Address Line 2:',['class'=>'form-label']) !!}
                                    {!! Form::text('addressLine2',$member->addressLine2 ,['class'=>'form-control']) !!}
                                    @error('addressLine2')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('city','City:',['class'=>'form-label']) !!}
                                    {!! Form::text('city',$member->city ,['class'=>'form-control']) !!}
                                    @error('city')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('postalCode','PostalCode:',['class'=>'form-label']) !!}
                                    {!! Form::text('postalCode',$member->postalCode ,['class'=>'form-control']) !!}
                                    @error('postalCode')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('country','Country:',['class'=>'form-label']) !!}
                                    {!! Form::text('country',$member->country ,['class'=>'form-control']) !!}
                                    @error('country')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="form-group mr-1">
                                        <button type="submit" class="btn btn-alt-primary">Update</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="block-content">
                        <div class="row push">
                            <div class="col-lg-2">
                                <p class="fs-sm text-muted">
                                    Here you can Update your Happy member.
                                </p>
                            </div>
                            <div class="col-lg-10">
                                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],
                                    'files'=>true])
                               !!}

                                <p>General</p>
                                <div class="mb-4">
                                    <label class="form-label">Your Avatar</label>
                                    <div class="mb-4">
                                        <img class="rounded-circle" height="150" width="150" src="{{$member->avatar ? asset('/card/avatars'). "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg')}}" alt="{{$member->avatar}}">
                                    </div>
                                    <div class="form-group mb-4">
                                        {!! Form::label('avatar_id', 'Choose a new avatar:', ['class'=>'form-label']) !!}
                                        {!! Form::file('avatar_id',['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    {!! Form::label('firstname','firstname:',['class'=>'form-label']) !!}
                                    {!! Form::text('firstname',$member->firstname ,['class'=>'form-control']) !!}
                                    @error('firstname')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('lastname','Lastname:',['class'=>'form-label']) !!}
                                    {!! Form::text('lastname',$member->lastname ,['class'=>'form-control']) !!}
                                    @error('lastname')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('email','Email:',['class'=>'form-label']) !!}
                                    {!! Form::text('email',$member->email ,['class'=>'form-control']) !!}
                                    @error('email')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('company','Company:',['class'=>'form-label']) !!}
                                    {!! Form::text('company',$member->company ,['class'=>'form-control']) !!}
                                    @error('company')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('age','Age:',['class'=>'form-label']) !!}
                                    {!! Form::date('age',$member->age ,['class'=>'form-control']) !!}
                                    @error('age')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('jobTitle','Job title:',['class'=>'form-label']) !!}
                                    {!! Form::text('jobTitle',$member->jobTitle ,['class'=>'form-control']) !!}
                                    @error('jobTitle')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('shortDescription','Short description:',['class'=>'form-label']) !!}
                                    {!! Form::text('shortDescription',$member->shortDescription ,['class'=>'form-control']) !!}
                                    @error('shortDescription')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('website','Website (use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('website',$member->website ,['class'=>'form-control']) !!}
                                    @error('website')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('notes','Notes:',['class'=>'form-label']) !!}
                                    {!! Form::textarea('notes',$member->notes ,['class'=>'form-control']) !!}
                                    @error('notes')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>

                                <p>Contact information</p>
                                <div class="form-group mb-4">
                                    {!! Form::label('mobileWork','Mobile work:',['class'=>'form-label']) !!}
                                    {!! Form::text('mobileWork',$member->mobileWork ,['class'=>'form-control']) !!}
                                    @error('mobileWork')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                                    {!! Form::text('mobile',$member->mobile ,['class'=>'form-control']) !!}
                                    @error('mobile')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('addressLine1','Address Line 1:',['class'=>'form-label']) !!}
                                    {!! Form::text('addressLine1',$member->addressLine1 ,['class'=>'form-control']) !!}
                                    @error('addressLine1')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('addressLine2','Address Line 2:',['class'=>'form-label']) !!}
                                    {!! Form::text('addressLine2',$member->addressLine2 ,['class'=>'form-control']) !!}
                                    @error('addressLine2')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('city','City:',['class'=>'form-label']) !!}
                                    {!! Form::text('city',$member->city ,['class'=>'form-control']) !!}
                                    @error('city')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('postalCode','PostalCode:',['class'=>'form-label']) !!}
                                    {!! Form::text('postalCode',$member->postalCode ,['class'=>'form-control']) !!}
                                    @error('postalCode')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('country','Country:',['class'=>'form-label']) !!}
                                    {!! Form::text('country',$member->country ,['class'=>'form-control']) !!}
                                    @error('country')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>


                                <p>Socials</p>
                                <div class="form-group mb-4">
                                    {!! Form::label('facebook','Facebook (use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('facebook',$member->facebook ,['class'=>'form-control']) !!}
                                    @error('facebook')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('instagram','Instagram (use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('instagram',$member->instagram ,['class'=>'form-control']) !!}
                                    @error('instagram')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('twitter','Twitter (use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('twitter',$member->twitter ,['class'=>'form-control']) !!}
                                    @error('twitter')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('youTube','YouTube (use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('youTube',$member->youTube ,['class'=>'form-control']) !!}
                                    @error('youTube')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('linkedIn','LinkedIn (use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('linkedIn',$member->linkedIn ,['class'=>'form-control']) !!}
                                    @error('linkedIn')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('tikTok','TikTok (use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('tikTok',$member->tikTok ,['class'=>'form-control']) !!}
                                    @error('tikTok')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('whatsApp','WhatsApp (use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('whatsApp',$member->whatsApp ,['class'=>'form-control']) !!}
                                    @error('whatsApp')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! Form::label('facebookMessenger','Messenger (Facebook - use "https://") :',['class'=>'form-label']) !!}
                                    {!! Form::text('facebookMessenger',$member->facebookMessenger ,['class'=>'form-control']) !!}
                                    @error('facebookMessenger')
                                    <p class="text-danger mt-2"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="form-group mr-1">
                                        <button type="submit" class="btn btn-alt-primary">Update</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- END member Profile -->
            <!-- END Page Content -->
    @endcan






@endsection

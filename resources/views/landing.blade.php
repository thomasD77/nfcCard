@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="hero bg-body-extra-light overflow-hidden"  style="background-image: url('images/content/background_3.png');
             background-repeat: no-repeat;
             background-position: center;
             background-size: cover">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <div class="card p-5 pb-0 shadow" style="border: none; ">
                            <h1 class="fw-bold mb-4">
                                Welcome to the world of SWAP!
                            </h1>
                            <p class="fs-lg  text-muted mb-4">
                                Click on the button below to login to your profile. <br> There you can change your data
                                and also follow up your SWAPS with other people.
                            </p>
                            <p>

                            </p>
                            <div>
                                <a class="btn btn-alt-primary text-white" style="background-color: #1F2A37; border: 1px solid #1F2A37" href="{{ route('admin.home') }}">
                                    Enter Dashboard
                                    <i class="fa fa-fw fa-arrow-right ms-1 text-white"></i>
                                </a>
                            </div>
                            <div class="pt-5">
                                <p class="text-muted">SWAP &copy; {{ now()->format('Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection

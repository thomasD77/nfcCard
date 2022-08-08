@extends('layouts.simple')

@section('content')
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: all .3s ease-in-out;
        }
    </style>
    <!-- Hero -->
    <div class="hero bg-body-extra-light overflow-hidden"  style="background-image: url('images/content/handshake.jpeg');
             background-repeat: no-repeat;
             background-position: center;
             background-size: cover">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card py-5 pb-0 shadow" style="border: none; ">
                            <h1 class="fw-bold mb-2">
                                Welcome to the world of SWAP!
                            </h1>
                            <p class="fs-lg  text-muted mb-4">
                                Click on the button below to login to your profile. <br> There you can change your data
                                and also follow up your SWAPS with other people.
                            </p>
                            <p>

                            </p>
                            <div>
                                <a class="btn btn-alt-primary" href="{{ route('admin.home') }}">
                                    Enter Dashboard
                                    <i class="fa fa-fw fa-arrow-right opacity-50 ms-1"></i>
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

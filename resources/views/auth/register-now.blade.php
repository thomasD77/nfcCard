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
                        <div class="card p-5 pb-0 shadow" style="border: none; background-color: rgba(255,255,255,0.65)">
                            <h1 class="fw-bold mb-4">
                                Welcome to the world of SWAP!
                            </h1>
                            <p class="fs-lg  text-muted mb-4">
                                Your account needs to be verified.
                                Please check your e-mail to make your registration complete.
                            </p>
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

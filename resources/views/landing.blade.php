@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="hero bg-body-extra-light overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <h1 class="fw-bold mb-2">
                    {{__('SWAP')}} <br><span class="fw-normal">{{__('Beyond')}}  <span class="text-city">{{__('Contact Sharing')}}</span></span>
                </h1>
                <p class="fs-lg fw-medium text-muted mb-4">
                    {{__("Welcome to the Content Management System! Let's explore!")}}
                </p>
                <a class="btn btn-alt-primary" href="{{ route('admin.home') }}">
                    {{__('Enter Dashboard')}}
                    <i class="fa fa-fw fa-arrow-right opacity-50 ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection

@extends('layouts.backend')

@section('content')

    @livewire('contact-detail', [ 'contact' => $contact ])

@endsection

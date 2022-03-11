@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
@endsection

@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    @livewireStyles
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Edit Profile
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">DataTable</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            List
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">User Profile</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Here you can change your account information. This will not influence your card information.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminUsersController@update',$user->id],
                      'files'=>true])
                       !!}
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-username', 'Username:',['class'=>'form-label']) !!}
                            {!! Form::text('username',$user->username ? $user->username : "" ,['class'=>'form-control']) !!}
                            @if(Session::has('user_username'))
                                <p class="alert alert-danger my-2">{{session('user_username')}}</p>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-name', 'Name:', ['class'=>'form-label']) !!}
                            {!! Form::text('name',$user->name,['class'=>'form-control']) !!}
                            @error('name')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-email', 'E-mail:', ['class'=>'form-label']) !!}
                            {!! Form::text('email',$user->email,['class'=>'form-control']) !!}
                            @error('email')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>

                        @canany(['is_admin', 'is_superAdmin'])
                            <div class="form-group mb-4">
                                {!! Form::label('one-profile-edit-roles', 'Select Role:', ['class'=>'form-label']) !!}
                                {!! Form::select('roles[]',$roles,$user->roles->pluck('id')->toArray(),['class'=>'form-control',])!!}
                            </div>
                        @endcan

                        @can('is_client')
                            <input type="hidden" name="roles" value="3">
                        @endcan

                        <div class="mb-4">
                            <label class="form-label">Your Avatar</label>
                            <div class="mb-4">
                                <img class="rounded-circle" height="80" width="80" src="{{$user->avatar ? asset('/') . $user->avatar->file : asset('/assets/front/img/Avatar-4.svg')}}" alt="{{$user->name}}">
                            </div>
                            <div class="form-group mb-4">
                                {!! Form::label('avatar_id', 'Choose a new avatar:', ['class'=>'form-label']) !!}
                                {!! Form::file('avatar_id',['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="form-group mr-1">
                                {!! Form::submit('Update',['class'=>'btn btn-alt-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Change Password -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Change Password</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Changing your sign in password is an easy way to keep your account secure.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminUsersController@updatePassword',$user->id]]) !!}
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-password', 'Current Password:',['class'=>'form-label']) !!}
                            {!! Form::password('currentPassword',['class'=>'form-control']) !!}
                            @if(Session::has('user_message'))
                                <p class="alert alert-danger my-2">{{session('user_message')}}</p>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-password-new', 'New Password:',['class'=>'form-label']) !!}
                            {!! Form::password('newPassword',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-password-new-confirm', 'Confirm Password:',['class'=>'form-label']) !!}
                            {!! Form::password('confirmPassword',['class'=>'form-control']) !!}
                            @if(Session::has('user_password'))
                                <p class="alert alert-danger my-2">{{session('user_password')}}</p>
                            @endif
                            @error('newPassword')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="form-group mr-1">
                                {!! Form::submit('Update',['class'=>'btn btn-alt-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <!-- END Change Password -->
@endsection




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
                        {{__('Edit Profile')}}
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">{{__('DataTable')}}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            {{__('List')}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    @can('is_user', $user)
    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- Referral User  -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{__('Referral code')}} </h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            {{__('Here you can see your referral code. Give this to people you know who wants a SWAP Card and get your 1 free year SWAP membership!')}}
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <!-- Referral code -->
                        <h5 class="badge bg-success text-white p-2">
                            {{ $user->member ? $user->member->referral : "" }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Referral User -->

        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{__('User Profile')}}</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            {{__('Here you can change your account information. This will not influence your card information.')}}
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminUsersController@update',$user->id],
                      'files'=>true])
                       !!}
                        @can('is_superAdmin')
                            <div class="form-group mb-4">
                                <label class="form-label">{{__('Business account')}}:</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" value="1" name="business" type="checkbox" id="flexSwitchCheckDefault" @if($user->business) checked @endif>
                                </div>
                            </div>
                        @endcan

                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-username', 'Username:',['class'=>'form-label']) !!}
                            {!! Form::text('username',$user->username ? $user->username : "" ,['class'=>'form-control']) !!}
                            @error('username')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
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

                        @can('is_superAdmin')
                            <div class="form-group mb-4">
                                {!! Form::label('one-profile-edit-roles', 'Select Role:', ['class'=>'form-label']) !!}
                                {!! Form::select('roles[]',$roles,$user->roles->pluck('id')->toArray(),['class'=>'form-control',])!!}
                            </div>
                        @endcan

                        @can('is_client')
                            <input type="hidden" name="roles" value="3">
                        @endcan

                        <div class="mb-4">
                            <label class="form-label">{{__('Your Avatar')}}</label>
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
                <h3 class="block-title">{{__('Change Password')}}</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            {{__('Changing your sign in password is an easy way to keep your account secure.')}}
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
            </div>
        </div>

        @canany(['is_superAdmin', 'is_admin'])
        <!-- Delete User  -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{__('Delete User/ Reset Card')}}</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            {{__('Here you can delete this user and reset the CARD')}}
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            {{__('DELETE/RESET')}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{__('Delete User/ Reset Card')}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{__('Are you sure you want to delete this user account? All the information will be lost forever.')}}
                                        {{_('The card data for this user will be deleted as well.')}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                                        <a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger">{{__('DELETE')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Delete User -->
        @endcanany
    </div>
    @endcan



@endsection




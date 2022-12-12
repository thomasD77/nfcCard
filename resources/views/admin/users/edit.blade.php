@extends('layouts.backend')

@section('css_before')
    <!-- Cropper css -->
    <style type="text/css">
        img {
            display: block;
            max-width: 100%;
        }
        .preview {
            overflow: hidden;
            width: 200px;
            height: 200px;
            margin: 10px;
            border: 1px solid red;
            border-radius:50%;
        }
        .modal-lg{
            max-width: 1000px !important;
        }
        .cropper-face{
            border-radius:50%;
            border: 5px dotted black;
        }
        .cropper-crop-box, .cropper-view-box{
            border-radius:50%;
        }
        .cropper-view-box {
            box-shadow: 0 0 0 1px #39f;
            outline: 0 !important;
        }
        .hide-message{
            display:none;
        }
    </style>
    <!-- end cropper css -->
@endsection

@section('content')
<!-- cropper -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop your image here</h5>
                <button type="button"  class="btn btn-dark text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" style="width: 100%">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-secondary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>
<!-- end cropper -->

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
                            <a class="link-fx" href="{{ asset('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        @canany(['is_superAdmin', 'is_admin'])
        <!-- Login User  -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Login information </h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Here you can see the user his login information. <br>
                            Count starting from (29/10/2022).
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-name', 'Latest login time:', ['class'=>'form-label']) !!}
                            {!! Form::text('name', $user->lastLoginDate() ? $user->lastLoginDate()->format('Y-m-d') : 0 ,['class'=>'form-control', 'disabled']) !!}
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-name', 'Number of logins:', ['class'=>'form-label']) !!}
                            {!! Form::text('name', $user->loginAttempts()->count() ,['class'=>'form-control', 'disabled']) !!}
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-name', 'Number of SWAPS:', ['class'=>'form-label']) !!}
                            {!! Form::text('name', $user->member->contacts->count() ,['class'=>'form-control', 'disabled']) !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END Login User -->
        @endcanany

        <!-- Referral User  -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Referral code </h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Here you can see your referral code. Give this to people you know who wants a SWAP Card and get your 1 free year SWAP membership!
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

                        @if(Session::has('ex_member'))
                            <p class="alert alert-info my-3">{{session('ex_member')}}</p>
                        @endif


                        {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminUsersController@update',$user->id],'files'=>true])!!}
                        @csrf

                        @can('is_superAdmin')
                            <div class="form-group mb-4">
                                <label class="form-label">Importer:</label>
                                <div class="alert alert-dark fs-sm">
                                    <div class="mt-2">
                                        <p class="mb-0">
                                            <i class="fa fa-fw fa-info me-1 mb-0"></i>
                                         If you are an importer you can sync data with your team
                                        </p>
                                    </div>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" value="1" name="is_importer" type="checkbox" id="flexSwitchCheckDefault" @if($user->is_importer) checked @endif>
                                </div>
                            </div>
                        @endcan

                        @can('is_superAdmin')
                            <div class="form-group mb-4">
                                <label class="form-label">Business account:</label>
                                <div class="alert alert-dark fs-sm">
                                    <div class="mt-2">
                                        <p class="mb-0">
                                            <i class="fa fa-fw fa-info me-1 mb-0"></i>
                                            If you have a business account, then you can access all Swap functionalities!
                                        </p>
                                    </div>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" value="1" name="business" type="checkbox" id="flexSwitchCheckDefault" @if($user->business) checked @endif>
                                </div>
                            </div>
                        @endcan

                        @can('is_superAdmin')
                            <div class="form-group mb-4">
                                <label class="form-label">Company account:</label>
                                <div class="alert alert-dark fs-sm">
                                    <div class="mt-2">
                                        <p class="mb-0">
                                            <i class="fa fa-fw fa-info me-1 mb-0"></i>
                                            Company account is a general account dedicated to a company, not a user.
                                        </p>
                                    </div>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" value="1" name="is_company" type="checkbox" id="flexSwitchCheckDefault" @if($user->is_company) checked @endif>
                                </div>
                            </div>
                        @endcan

                        <div class="form-group mb-4">
                            <label class="form-label">Public account:</label>
                            <div class="alert alert-dark fs-sm">
                                <div class="mt-2">
                                    <p class="mb-0">
                                        <i class="fa fa-fw fa-info me-1 mb-0"></i>
                                        If you have a public account, other people can find your profile through your team members.
                                    </p>
                                </div>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" value="1" name="is_public" type="checkbox" id="flexSwitchCheckDefault" @if($user->member ? $user->member->is_public : "") checked @endif>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-name', 'Name:', ['class'=>'form-label']) !!}
                            {!! Form::text('name',$user->name,['class'=>'form-control']) !!}
                            @error('name')
                            <p class="text-danger mt-2"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-name', 'E-mail:', ['class'=>'form-label']) !!}
                            <input type="text" class="form-control" disabled value="{{ $user->email }}">
                        </div>

                        @can('is_superAdmin')
                            <div class="form-group mb-4">
                                {!! Form::label('one-profile-edit-email', 'E-mail:', ['class'=>'form-label']) !!}
                                {!! Form::text('email',$user->email,['class'=>'form-control']) !!}
                                @error('email')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                {!! Form::label('date','Select end trial date:', ['class'=>'form-label']) !!}
                                {!! Form::date('trial_date', $user->member->listurl ? $user->member->listurl->trial_date : null,['class'=>'form-control'])!!}
                            </div>
                        @endcan

                        @canany(['is_superAdmin', 'is_admin'])
                            <div class="form-group mb-4">
                                {!! Form::label('one-profile-edit-roles', 'Select Role:', ['class'=>'form-label']) !!}
                                {!! Form::select('roles[]',$roles,$user->roles->pluck('id')->toArray(),['class'=>'form-control',])!!}
                            </div>
                        @endcanany


                        @can('is_client')
                            <input type="hidden" name="roles" value="3">
                        @endcan

                        <div class="mb-4">
                            <label class="form-label">Your Avatar</label>
                            <div class="mb-4">
                                <img class="rounded-circle avatar-preview" height="80" width="80" src="{{$user->avatar ? asset('/') . $user->avatar->file : asset('/assets/front/img/Avatar-4.svg')}}" alt="{{$user->name}}">
                            </div>
                            <div class="d-flex justify-content-center">
                                <p class="alert avatar-message hide-message">This is a message</p>
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

        @if($user->team)
        <!-- Team -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Company</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Here is your company information.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">

                        {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminUsersController@updateTeam',$user],'files'=>true])!!}
                        @csrf
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-email', 'Name:', ['class'=>'form-label']) !!}
                            @if($role == 'client')
                                {!! Form::text('name',$user->team->name,['class'=>'form-control', 'disabled']) !!}
                            @else
                                {!! Form::text('name',$user->team->name,['class'=>'form-control', 'disabled']) !!}
                                @error('name')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-email', 'VAT:', ['class'=>'form-label']) !!}
                            @if($role == 'client')
                                {!! Form::text('VAT',$user->team->VAT,['class'=>'form-control', 'disabled']) !!}
                            @else
                                {!! Form::text('VAT',$user->team->VAT,['class'=>'form-control']) !!}
                                @error('VAT')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-email', 'Phone:', ['class'=>'form-label']) !!}
                            @if($role == 'client')
                                {!! Form::text('phone',$user->team->phone,['class'=>'form-control', 'disabled']) !!}
                            @else
                                {!! Form::text('phone',$user->team->phone,['class'=>'form-control']) !!}
                                @error('phone')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-email', 'Street:', ['class'=>'form-label']) !!}
                            @if($role == 'client')
                                {!! Form::text('street',$user->team->teamAddress->street,['class'=>'form-control', 'disabled']) !!}
                            @else
                                {!! Form::text('street',$user->team->teamAddress->street,['class'=>'form-control']) !!}
                                @error('street')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-email', 'Number:', ['class'=>'form-label']) !!}
                            @if($role == 'client')
                                {!! Form::text('number',$user->team->teamAddress->number,['class'=>'form-control', 'disabled']) !!}
                            @else
                                {!! Form::text('number',$user->team->teamAddress->number,['class'=>'form-control']) !!}
                                @error('number')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-email', 'Zip:', ['class'=>'form-label']) !!}
                            @if($role == 'client')
                                {!! Form::text('zip',$user->team->teamAddress->zip,['class'=>'form-control', 'disabled']) !!}
                            @else
                                {!! Form::text('zip',$user->team->teamAddress->zip,['class'=>'form-control']) !!}
                                @error('zip')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-email', 'City:', ['class'=>'form-label']) !!}
                            @if($role == 'client')
                                {!! Form::text('city',$user->team->teamAddress->city,['class'=>'form-control', 'disabled']) !!}
                            @else
                                {!! Form::text('city',$user->team->teamAddress->city,['class'=>'form-control']) !!}
                                @error('city')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('one-profile-edit-email', 'Country:', ['class'=>'form-label']) !!}
                            @if($role == 'client')
                                {!! Form::text('country',$user->team->teamAddress->country,['class'=>'form-control', 'disabled']) !!}
                            @else
                                {!! Form::text('country',$user->team->teamAddress->country,['class'=>'form-control']) !!}
                                @error('country')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        @if($role != 'client')
                            <div class="form-group mb-4">
                                {!! Form::label('one-profile-edit-email', 'Description:', ['class'=>'form-label']) !!}
                                {!! Form::textarea('description',$user->team->description,['class'=>'form-control']) !!}
                                @error('description')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                            </div>

                            {!! Form::submit('Update',['class'=>'btn btn-alt-primary']) !!}
                        @endif

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        @endif

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
                        @csrf
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
                <h3 class="block-title">Delete User/ Reset Card</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Here you can delete this user and reset the CARD
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            DELETE/RESET
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete User/ Reset Card</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this user account? All the information will be lost forever.
                                        The card data for this user will be deleted as well.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger">DELETE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Delete User -->

        @can('is_superAdmin')
            <!-- Keep User / Reset card  -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Keep User/ Reset Card</h3>
                </div>
                <div class="block-content">
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Here you can keep the user account but reset his CARD ID
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">

                            <p class="mb-1"><strong>Current user acc:</strong></p>
                            <p class="mb-1"><span class="text-muted me-2" style="font-size: 10px">Name: </span>{{ $user->name }}</p>
                            <p class="mb-1"><span class="text-muted me-2" style="font-size: 10px">Email: </span> {{ $user->email }}</p>
                            <p class="mb-3"><span class="text-muted me-2" style="font-size: 10px">Team: </span>{{ $user->team->name }}</p>

                            <p class="mb-1"><strong>Current member settings:</strong></p>
                            <p class="mb-1"><span class="text-muted me-2" style="font-size: 10px">ID #: </span>{{ $user->member->id }}</p>
                            <p class="mb-1"><span class="text-muted me-2" style="font-size: 10px">Name: </span>{{ $user->member->firstname }} {{ $user->member->lastname }}</p>
                            <p class="mb-3"><span class="text-muted me-2" style="font-size: 10px">Email: </span>{{ $user->member->email }}</p>

                            <p class="mb-1"><strong>Current URL settings (click to see profile):</strong></p>
                            <div class="mb-3">
                                @if($user->member)
                                    @if($user->member->card_id != 0)
                                        <a target="_blank" href="{{ route('direction') . "?" . $user->member->card_id }}"><span class="badge badge-pill p-2 bg-dark">Profile {{ $user->member->card_id }}</span></a>
                                    @else
                                        <a target="_blank" href="{{ route('direction.test', $user->member) }}"><span class="badge badge-pill bg-warning p-2">TEST MODE</span></a>
                                    @endif
                                @endif
                            </div>

                            @if($user->reset_message)
                                <label class="form-label"><strong>User reset information: </strong></label>
                                <textarea class="form-control" disabled> {{ $user->reset_message }}</textarea>
                            @endif

                            @if($user->member->card_id != 0)
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModalKeep">
                                KEEP/RESET
                            </button>
                            @endif

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalKeep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabelKeep">Keep User/ Reset Card</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminUsersController@keep',$user->id]]) !!}

                                            <p class="bg-danger-light p-2 mb-4"> Are you sure you want to delete the CARD ID on this member?
                                            This way the URL with this card ID will be available again.
                                            But the USER ACC will not be lost.</p>

                                            <div class="my-3">
                                                {!! Form::label('one-profile-edit-email', 'Write down extra information for this user account:', ['class'=>'form-label']) !!}
                                                {!! Form::textarea('reset_message',$user->reset_message,['class'=>'form-control', 'required']) !!}
                                                @error('description')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            {!! Form::submit('RESET',['class'=>'btn btn-alt-primary']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-header block-header-default">
                    <h3 class="block-title">Set new CARD ID for User </h3>
                </div>
                <div class="block-content">
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Here you update the user his CARD ID (for example, set demo to live acc)
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group mb-4">
                                {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminUsersController@updateURL',$user->id]]) !!}
                                @csrf
                                {!! Form::label('one-profile-edit-urls', 'Select URL:', ['class'=>'form-label']) !!}
                                {!! Form::select('url',$urls, [$user->member->card_id] ? [$user->member->card_id] : null ,['class'=>'form-control', 'placeholder'=> 'NONE'])!!}
                                <div class="form-group mr-1">
                                    {!! Form::submit('UPDATE',['class'=>'btn btn-alt-info mt-2']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Keep user / Reset card -->
        @endcan
        @endcanany
    </div>

<!-- Cropper js -->
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous" />--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
<script>

    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;

    $("body").on("change", "#avatar_id", function(e){

        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];
            if(file.size <= 2097152) {
                let ext = file.name.split(".")[1];
                if (ext === "jpg" || ext === "JPG" || ext === "JPEG" || ext === "PNG" || ext === "jpeg" || ext === "png") {
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                } else {
                    $(e.target).val('');
                    $modal.modal('hide');
                    $(".avatar-message").removeClass("hide-message");
                    $(".avatar-message").removeClass("alert-success");
                    if(!$(".avatar-message").hasClass('alert-danger')){
                        $(".avatar-message").toggleClass("alert-danger");
                    }
                    $(".avatar-message").text("Valid types jpg, jpeg and png");
                    //alert('Valid image types are (.jpg , .png , .jpeg)');
                }
            } else{
                $(e.target).val('');
                $modal.modal('hide');
                $(".avatar-message").removeClass("hide-message");
                $(".avatar-message").removeClass("alert-success");
                if(!$(".avatar-message").hasClass('alert-danger')){
                    $(".avatar-message").toggleClass("alert-danger");
                }
                $(".avatar-message").text("Image is to large");
                //alert('The image you want to upload is to large');
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/admin/image-cropper/upload",
                    data: {
                        '_token': $('meta[name="_token"]').attr('content'),
                        'image': base64data,
                        'name' :  $("#avatar_id").val(),
                        'base': 'media/avatars/',
                        "type": "avatar",
                        'user_id': {{ $user->id }},
                        "uploadType": 'user'
                    },

                    success: function(data){
                        if(data.success === "success"){
                            $modal.modal('hide');
                            $(".avatar-preview").attr("src", "/media/avatars/" + data.name);
                            $(".avatar-message").removeClass("hide-message");
                            $(".avatar-message").removeClass("alert-danger");
                            if(!$(".avatar-message").hasClass('alert-success')){
                                $(".avatar-message").toggleClass("alert-success");
                            }
                            $(".avatar-message").text("Successfully updated");
                            $("#avatar_id").val('');
                            //alert("success upload image (don't forget to save)");
                        } else if(data.success === "no"){
                            $modal.modal('hide');
                            //alert('Valid image types are (.jpg , .png , .jpeg)');
                        }
                    }
                });
            }
        });
    })

</script>
    <!-- cropper js -->



@endsection




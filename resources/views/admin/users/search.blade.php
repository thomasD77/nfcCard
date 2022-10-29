@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Users
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ asset('/admin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Users
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded row">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Users
                </h3>
                <a href="{{route('users.index')}}">
                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Back to List">
                        <i class="far fa-list-alt "></i>
                    </button>
                </a>
            </div>
            <div class="block-content block-content-full overflow-scroll">
                <div class="parent">
                @include('admin.includes.flash')
                <!-- Search Form (visible on larger screens) -->
                    <form class="" action="{{action('App\Http\Controllers\AdminUsersController@searchUser')}}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-alt w-50" style="width: 50%" placeholder="Search for name..." id="page-header-search-input2" name="user">
                            <span class="input-group-text border-0"><button class="border border-0" type="submit"><i class="fa fa-fw fa-search"></i></button></span>
                        </div>
                    </form>
                    <!-- END Search Form -->
                    <table class="table table-striped table-hover table-vcenter fs-sm">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Card ID</th>

                            @canany(['is_superAdmin', 'is_admin'])
                                <th scope="col">Actions</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @if($users)
                            @foreach($users as $user)
                                @if($user->id != 1)
                                <tr>
                                    <td>{{$user->id ? $user->id : 'No ID'}}</td>
                                    <td>{{$user->name ? $user->name : 'No Name'}}</td>
                                    <td><img class="rounded-circle" height="62" width="62" src="{{$user->avatar ? asset('/') . $user->avatar->file : asset('/assets/front/img/avatar-2.svg') }}" alt="{{$user->name}}"></td>
                                    <td>{{$user->email ? $user->email : 'No Email'}}</td>
                                    <td>@foreach($user->roles as $role)
                                            <span class="rounded-pill bg-info-light text-info p-2">{{$role->name ? $role->name : 'No Role'}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($user->member)
                                            @if($user->member->card_id != 0)
                                                <a target="_blank" href="{{ route('direction') . "?" . $user->member->card_id }}"><span class="badge badge-pill p-2 bg-dark">Profile {{ $user->member->card_id }}</span></a>
                                            @else
                                                <a target="_blank" href="{{ route('direction.test', $user->member) }}"><span class="badge badge-pill bg-warning p-2">TEST MODE</span></a>
                                            @endif
                                        @endif
                                    </td>
                                    @canany(['is_superAdmin', 'is_admin'])
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('users.edit', $user->id)}}">
                                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit User">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $users->links()  !!}
                </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection

<div class="parent">
    @include('admin.includes.flash')
    <!-- Search Form (visible on larger screens) -->
        <form class="d-none d-md-inline-block col-6" action="{{action('App\Http\Controllers\AdminUsersController@searchUser')}}" method="POST">
            @csrf
            <div class="input-group input-group-sm">
                <input type="text" class="form-control form-control-alt" placeholder="Search for name..." id="page-header-search-input2" name="user">
                <span class="input-group-text border-0"><button class="border border-0" type="submit"><i class="fa fa-fw fa-search"></i></button></span>
            </div>
        </form>
        <!-- END Search Form -->
<table class="table table-striped table-hover table-vcenter fs-sm">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col"># User ID</th>
        <th scope="col">Avatar</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col"># Card ID</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if($users)
        @foreach($users as $user)
            <tr>
                <td>{{ $loop->index + 1  }}</td>
                <td>{{$user->name ? $user->name : 'No Name'}}</td>
                <td>{{$user->id ? $user->id : 'No ID'}}</td>
                <td><img class="rounded-circle" height="62" width="62" src="{{$user->avatar ? asset('/') . $user->avatar->file : asset('/assets/front/img/avatar-2.svg') }}" alt="{{$user->name}}"></td>
                <td>{{$user->email ? $user->email : 'No Email'}}</td>
                <td>@foreach($user->roles as $role)
                        <span class="rounded-pill bg-info-light text-info p-2">{{$role->name ? $role->name : 'No Role'}}</span>
                    @endforeach
                </td>
                <td>{{$user->member ? '# ' . $user->member->card_id : 'No Card ID'}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('users.edit', $user->id)}}">
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit User">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                        </a>
                        <button class="btn btn-sm btn-alt-secondary" wire:click="archiveUser({{$user->id}})"><i class="fa fa-archive"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</div>
<div class="d-flex justify-content-center">
    {!! $users->links()  !!}
</div>

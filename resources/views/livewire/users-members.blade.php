<div class="parent">
    @include('admin.includes.flash')

    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Company</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col"># Card ID</th>
            <th scope="col">Actions</th>
            <th scope="col">Member profile</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{ $loop->index + 1  }}</td>
                    <td><img class="rounded-circle" height="62" width="62" src="{{$user->avatar ? asset('/') . $user->avatar->file : asset('/assets/front/img/avatar-2.svg') }}" alt="{{$user->name}}"></td>
                    <td>{{$user->name ? $user->name : 'No Name'}}</td>
                    <td>{{$user->team ? $user->team->name : 'No Company'}}</td>
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
                            <button class="btn btn-sm btn-alt-secondary" wire:click="archiveUser({{$user->id}})" data-bs-toggle="tooltip" title="Archive User">
                                <i class="fa fa-archive"></i>
                            </button>
                        </div>
                    </td>
                    <td>
                        <div class="card shadow" style="border:none">
                            <div class="card-header d-flex justify-content-between">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="">{{ $user->member->firstname }} {{ $user->member->lastname }}</h5>
                                    </div>
                                    <div class="col-md-4 d-flex">
                                        <a href="{{route('members.edit', $user->member->id)}}">
                                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                        </a>
                                        <div>
                                            <a href="{{ route('contacts.index.client', $user) }}" class="btn btn-sm btn-alt-info text-center d-flex" data-bs-toggle="tooltip" title="Scans">
                                                <i class="fa fa-mouse"></i><small class="px-1">{{ $user->member->contacts->count() }}</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->member->email }}</h5>
                                <p class="card-text">{{ $user->member->company }}</p>
                                <p class="card-text">{{ $user->member->material->name }}</p>
                            </div>
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

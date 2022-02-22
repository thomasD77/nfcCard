<div>
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            @canany(['is_superAdmin', 'is_admin'])
                <th scope="col">role</th>
            @endcanany
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($members)
            @foreach($members as $member)
                @if($active_user_role == 'client')
                    @if($active_user == $member->user_id)
                        <tr>
                            <td>{{$member->id ? $member->id : 'No ID'}}</td>
                            <td>{{$member->lastname ? $member->lastname : 'MEMBER' . $member->id}} {{ $member->firstname ? $member->firstname : '' }}</td>
                            <td>{{$member->email ? $member->email : 'MEMBER-' . $member->id}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('members.edit', $member->id)}}">
                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('members.show', $member->id)}}">
                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                @else
                    <tr>
                        <td>{{$member->id ? $member->id : 'No ID'}}</td>
                        <td>{{$member->lastname ? $member->lastname : 'MEMBER-' . $member->id}} {{ $member->firstname ? $member->firstname : '' }}</td>
                        <td>{{$member->email ? $member->email : 'MEMBER-' . $member->id}}</td>
                        <td>{{$member->user ? $member->user->roles->first()->name : 'MEMBER' . $member->id}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('members.edit', $member->id)}}">
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                </a>
                                <button class="btn btn-sm btn-alt-secondary" wire:click="archiveMember({{$member->id}})"><i class="fa fa-archive"></i></button>
                                <a href="{{route('members.landingpageDefault', $member->id)}}">
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $members->links()  !!}
</div>

<div>
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">Registered</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($members)
            @foreach($members as $member)
                <tr>
                    <td>{{$member->id ? $member->id : 'No ID'}}</td>
                    <td>{{$member->lastname ? $member->lastname : ''}} {{ $member->firstname ? $member->firstname : '' }}</td>
                    <td>{{$member->email ? $member->email : 'No email'}}</td>
                    <td>{{$member->created_at ? $member->created_at->diffForHumans() : 'Not Verified'}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('members.edit', $member->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                            </a>
                            <button class="btn btn-sm btn-alt-secondary" wire:click="archiveMember({{$member->id}})"><i class="fa fa-archive"></i></button>
                            <a href="{{route('members.show', $member->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                    <i class="far fa-eye"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $members->links()  !!}
</div>

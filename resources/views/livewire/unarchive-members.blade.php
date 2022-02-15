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

                    <td class="text-center">
                        <button class="btn btn-sm btn-alt-secondary"
                                data-bs-toggle="tooltip" title="Reset Member"
                                wire:click="unArchiveMember({{$member->id}})"><i class="si si-refresh "></i></button>
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

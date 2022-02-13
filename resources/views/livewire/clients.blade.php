<div>
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">name</th>
            <th scope="col">username</th>
            <th scope="col">email</th>
            <th scope="col">Registered</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($clients)
            @foreach($clients as $client)
                <tr>
                    <td>{{$client->id ? $client->id : 'No ID'}}</td>
                    <td>{{$client->name ? $client->name : 'No name'}}</td>
                    <td>{{$client->username ? $client->username : 'No Username'}}</td>
                    <td>{{$client->email ? $client->email : 'No email'}}</td>
                    <td>{{$client->created_at ? $client->created_at->diffForHumans() : 'Not Verified'}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('clients.edit', $client->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit client">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                            </a>
                            <button class="btn btn-sm btn-alt-secondary" wire:click="archiveClient({{$client->id}})"><i class="fa fa-archive"></i></button>
                            <a href="{{route('clients.show', $client->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show client">
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
    {!! $clients->links()  !!}
</div>

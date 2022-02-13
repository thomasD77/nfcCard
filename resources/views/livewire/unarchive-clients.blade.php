<div class="block-content block-content-full overflow-scroll">
    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Registered</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($clients)
            @foreach($clients as $client)
                <tr>
                    <td>{{$client->id ? $client->id : 'No ID'}}</td>
                    <td>{{$client->name ? $client->name : 'No Name'}}</td>
                    <td>{{$client->username ? $client->username : 'No Username'}}</td>
                    <td>{{$client->email ? $client->email : 'No email'}}</td>
                    <td>{{$client->created_at ? $client->created_at->diffForHumans() : 'Not Verified'}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-alt-secondary" wire:click="unArchiveClient({{$client->id}})"><i class="si si-refresh "></i></button>
                            <a href="{{route('clients.show', $client->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit client">
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

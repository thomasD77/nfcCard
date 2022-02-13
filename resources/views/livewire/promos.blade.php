<div>
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Registered</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($promos)
            @foreach($promos as $promo)
                <tr>
                    <td>{{$promo->id ? $promo->id : 'No ID'}}</td>
                    <td>{{$promo->name ? $promo->name : 'No Name'}}</td>
                    <td>{{$promo->created_at ? $promo->created_at->diffForHumans() : 'Not Verified'}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('promos.edit', $promo->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit promo">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                            </a>
                            <button class="btn btn-sm btn-alt-secondary" wire:click="archivePromo({{$promo->id}})"><i class="fa fa-archive"></i></button>
                            <a href="{{route('promos.show', $promo->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show promo">
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
    {!! $promos->links()  !!}
</div>
